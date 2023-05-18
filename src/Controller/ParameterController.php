<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Images;
use App\Entity\Providers;
use App\Form\UsersFormType;
use App\Form\ImagesFormType;
use App\Service\PictureService;
use App\Repository\ImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ParameterController extends AbstractController
{
    #[Route('/parameter/user-info/{id}', name: 'app_parameter_user_info')]
    // #[IsGranted("ROLE_USER", subject:"choosenUser", message:"Vous ne pouvez accéder qu'à votre propre profil.")]
    #[IsGranted('ROLE_USER')]
    public function user_info(
        $id,
        Request $request,
        PictureService $pictureService,
        CategoriesOfServicesRepository $categRepository,
        EntityManagerInterface $entityManager,
        ImagesRepository $imagesRepository,
        ParameterBagInterface $parameterBagInterface,
    ): Response {
        // Récupération de l'utilisateur connecté
        $choosenUser = $this->getUser();

        // On vérifie si c'est un prestataire ou internaute 
        $methodName = 'get' . $choosenUser->getUserType();
        $user = call_user_func([$choosenUser, $methodName]);
        $userId = $user->getId();
        
        $error = null;

        // Vérifie que l'utilisateur connecté est le propriétaire des données
        if ($userId != $id) {
            $this->addFlash(
                'errors',
                'Vous ne pouvez accéder qu\'à votre propre profil.'
            );

            return $this->redirectToRoute('app_parameter_user_info', ['id' => $userId]);
        }

        $list_categ = $categRepository->findAll();

        // On crée la première partie du formulaire 
        $userForm = $this->createForm(UsersFormType::class, $choosenUser);
        $userForm->handleRequest($request);

        // On crée la deuxième partie formulaire en fonction du type de l'utilisateur 
        $type = $choosenUser->getUserType() . 'FormType';
        $formType = 'App\Form\\' . $type;
        $userTypeForm = $this->createForm($formType, $user);
        $userTypeForm->handleRequest($request);

        // On crée un formulaire pour upload et edit la photo de profile 
        $photo = $imagesRepository->findOneBy(['providerPhoto' => $user->getId()]);
        if (!$photo) {
            $photo = new Images();
        }
        $photoForm = $this->createForm(ImagesFormType::class, $photo);
        $photoForm->handleRequest($request);

        // On crée un formulaire pour upload et edit le logo 
        $logo = new Images();
        $logoForm = $this->createForm(ImagesFormType::class, $logo);
        $logoForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid() && $userTypeForm->isSubmitted() && $userTypeForm->isValid()) {
            // dd($userTypeForm);
            $entityManager->persist($choosenUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        if ($photoForm->isSubmitted() && $photoForm->isValid()) {
            $image = $photoForm->get('name')->getData();
            if ($image) {
                $folder = $choosenUser->getUserType();
                $id = $user->getId();
                
                if ($choosenUser->getUserType() == "InternetUsers") {
                    $verif = $imagesRepository->findOneBy(['internetUser' => $id]);
                    
                    if ($verif) {
                        // dd($verif->getName());
                        $oldPicture = $verif->getName();
                        

                        $path = $parameterBagInterface->get('image_directory') . $folder . '/' . $oldPicture;
                        if (file_exists($path)) {
                            unlink($path);
                        }
    
                        $fichier = $pictureService->add($image, $folder);
    
                        $verif->setName($fichier);
                        $user->setImages($verif);
                    } else {
                        $fichier = $pictureService->add($image, $folder);
                        $img = new Images();
                        $img->setName($fichier);
                        $user->setImages($img);
                    }
                }
                if ($choosenUser->getUserType() == "Providers") {
                    $verif = $imagesRepository->findOneBy(['providerPhoto' => $id]);
                    
                    if ($verif) {
                        $oldPicture = $verif->getName();

                        $path = $parameterBagInterface->get('image_directory') . $folder . '/' . $oldPicture;
                        if (file_exists($path)) {
                            unlink($path);
                        }
    
                        $fichier = $pictureService->add($image, $folder);
    
                        $verif->setName($fichier);
                        $user->setProviderPhoto($verif);
                    } else {
                        $fichier = $pictureService->add($image, $folder);
                        $img = new Images();
                        $img->setName($fichier);
                        $entityManager->persist($img);
                        $entityManager->flush();

                        $user->setProviderPhoto($img);
                    }
                }

                $entityManager->persist($choosenUser);
                $entityManager->flush();
            }
            return $this->redirectToRoute('app_parameter_user_info', ['id' => $user->getId()]);
        }

        
        return $this->render('parameter/parameter.html.twig', compact(
            'list_categ',
            'userForm',
            'userTypeForm',
            'photoForm',
            'logoForm',
            'error'
        ));
    }

    #[Route('/parameter/user-info/logo/{id}', name: 'app_parameter_logo')]
    // #[IsGranted("ROLE_USER", subject:"choosenUser", message:"Vous ne pouvez accéder qu'à votre propre profil.")]
    #[IsGranted('ROLE_USER')]
    public function logo(
        Request $request,
        Providers $provider,
        PictureService $pictureService,
        ImagesRepository $imagesRepository,
        EntityManagerInterface $entityManager,
        ParameterBagInterface $parameterBagInterface,
    ): Response {
        // Récupération de l'utilisateur connecté
        $user = $this->getUser();

        $logo = $imagesRepository->findOneBy(['providerPhoto' => $user->getId()]);
        if (!$logo) {
            $logo = new Images();
        }
        $logoForm = $this->createForm(ImagesFormType::class, $logo);
        $logoForm->handleRequest($request);
        
        if ($logoForm->isSubmitted() && $logoForm->isValid()) {
            $logoData = $logoForm->get('name')->getData();

            if ($logoData) {
                $folder = 'logo';
                $id = $provider->getId();

                $verif = $imagesRepository->findOneBy(['providerLogo' => $id]);

                if ($verif) {
                    $oldPicture = $verif->getName();

                    $path = $parameterBagInterface->get('image_directory') . $folder . '/' . $oldPicture;
                    if (file_exists($path)) {
                        unlink($path);
                    }

                    $fichier = $pictureService->add($logoData, $folder);

                    $verif->setName($fichier);
                    $provider->setProviderLogo($verif);
                } else {
                    $fichier = $pictureService->add($logoData, $folder);
                    $logo->setName($fichier);
                    $entityManager->persist($logo);
                    $entityManager->flush();

                    $provider->setProviderLogo($logo);
                }
            }
            $entityManager->persist($user);
            $entityManager->flush();
            
        }
        return $this->redirectToRoute('app_parameter_user_info', ['id' => $provider->getId()]);
    }
}
