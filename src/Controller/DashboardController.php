<?php

namespace App\Controller;

use App\Entity\Promotions;
use App\Entity\Providers;
use App\Repository\PromotionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use App\Repository\ProvidersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/dashboard/{type}/new', name: 'app_dashboard_new')]
    public function new(
        $type,
        Request $request,
        CategoriesOfServicesRepository $categRepository,
        EntityManagerInterface $entityManager,
        ProvidersRepository $providersRepository,
    ): Response {
        $list_categ = $categRepository->findAll();
        
        // Récupération de l'utilisateur connecté
        $user = $this->getUser();
        $provider = $user->getProviders()->getId();
        $provider = $providersRepository->findOneBy(['id' => $provider]);

        
        // On instance le service ou le stage 
        $class = 'App\Entity\\' . ucfirst($type);
        $class = new $class;
        
        $newServiceOrStage = 'App\Form\\' . ucfirst($type) . 'FormType';
        $form = $this->createForm($newServiceOrStage, $class);
        $form->handleRequest($request);
                
        if($form->isSubmitted() && $form->isValid()) {
            // dd($form, $class);
            $class->setProviders($provider);
            $entityManager->persist($class);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_home');
        }

        return $this->render('dashboard/dashboard.html.twig', compact(
            'list_categ',
            'form',
            'type'
        ));
    }

    #[Route('/dashboard/service/{id}', name: 'app_dashboard_service')]
    public function index(
        Providers $providers,
        CategoriesOfServicesRepository $categRepository,
        PromotionsRepository $promotionsRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        $list_promotion = $promotionsRepository->findBy(['providers' => $providers->getId()]);

        return $this->render('dashboard/dashboard.html.twig', compact(
            'list_categ',
            'list_promotion'
        ));
    }


}
