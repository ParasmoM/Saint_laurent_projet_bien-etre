<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersFormType;
use App\Form\ImagesFormType;
use App\Repository\ImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParameterController extends AbstractController
{
    #[Route('/parameter/user-info/{id}', name: 'app_parameter_user_info')]
    // #[IsGranted('ROLE_USER')]
    #[IsGranted("ROLE_USER", subject:"choosenUser", message:"Vous ne pouvez accéder qu'à votre propre profil.")]
    public function user_info(
        $id, 
        Users $choosenUser,
        Request $request,
        CategoriesOfServicesRepository $categRepository,
        EntityManagerInterface $entityManager,
        ImagesRepository $imagesRepository
    ): Response {
        $list_categ = $categRepository->findAll();

        // Récupération de l'utilisateur connecté
        // $choosenUser = $this->getUser();

        // dd($choosenUser);
        $userForm = $this->createForm(UsersFormType::class, $choosenUser);
        $userForm->handleRequest($request);

        // On récupère en fonction de s’il est internaute ou prestataire 
        $methodName = 'get' . $choosenUser->getUserType() . 's';
        $utilisateur = call_user_func([$choosenUser, $methodName]);

        // On crée le formulaire en fonction du type de l'utilisateur 
        $type = $choosenUser->getUserType() . 'sFormType';
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
            // On récupère l'image du form
            $photo = $photoForm->get('name')->getData();

            dd($photoForm, $photo);
            $entityManager->persist($choosenUser);
            $entityManager->flush();

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