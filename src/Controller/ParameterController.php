<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Images;
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
    // #[IsGranted('ROLE_USER')]
    #[IsGranted("ROLE_USER", subject:"choosenUser", message:"Vous ne pouvez accéder qu'à votre propre profil.")]
    public function user_info(
        $id, 
        Users $choosenUser,
        Request $request,
        PictureService $pictureService,
        CategoriesOfServicesRepository $categRepository,
        EntityManagerInterface $entityManager,
        ImagesRepository $imagesRepository,
        ParameterBagInterface $parameterBagInterface,
    ): Response {
        $list_categ = $categRepository->findAll();

        // Récupération de l'utilisateur connecté
        // $choosenUser = $this->getUser();

        // dd($choosenUser);
        $userForm = $this->createForm(UsersFormType::class, $choosenUser);
        $userForm->handleRequest($request);
        // dd($choosenUser);
        // On récupère en fonction de s’il est internaute ou prestataire 
        $methodName = 'get' . $choosenUser->getUserType();
        $utilisateur = call_user_func([$choosenUser, $methodName]);

        // On crée le formulaire en fonction du type de l'utilisateur 
        $type = $choosenUser->getUserType() . 'FormType';
        $formType = 'App\Form\\' . $type;

        $userTypeForm = $this->createForm($formType, $utilisateur);
        $userTypeForm->handleRequest($request);

        $photo = $imagesRepository->findOneBy(['providerPhoto' => $utilisateur->getId()]);
        // dd($photo);
        $photoForm = $this->createForm(ImagesFormType::class, $photo);
        $photoForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid() && $userTypeForm->isSubmitted() && $userTypeForm->isValid()) {
            $entityManager->persist($choosenUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        if ($photoForm->isSubmitted() && $photoForm->isValid()) {
            $image = $photoForm->get('name')->getData();
            
            if ($image) {
                $folder = $choosenUser->getUserType();
                $id = $utilisateur->getId();
                
                if ($choosenUser->getUserType() == "InternetUsers") {
                    $verif = $imagesRepository->findOneBy(['internetUser' => $id]);
    
                    if ($verif) {
                        $oldPicture = $verif->getName();

                        $path = $parameterBagInterface->get('image_directory') . $folder . '/' . $oldPicture;
                        if (file_exists($path)) {
                            unlink($path);
                        }
    
                        $fichier = $pictureService->add($image, $folder);
    
                        $verif->setName($fichier);
                        $utilisateur->setImages($verif);
                    } else {
                        $fichier = $pictureService->add($image, $folder);
                        $img = new Images();
                        $img->setName($fichier);
                        $utilisateur->setImages($img);
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
                        $utilisateur->setImages($verif);
                        dd('if');
                    } else {
                        dd('else');
                    }
                }
                $entityManager->persist($choosenUser);
                $entityManager->flush();

            }




            return $this->redirectToRoute('app_home');
        }
        return $this->render('parameter/parameter.html.twig', compact(
            'list_categ',
            'userForm',
            'userTypeForm',
            'photoForm'
        ));
    }
}
