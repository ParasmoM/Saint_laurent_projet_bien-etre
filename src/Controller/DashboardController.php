<?php

namespace App\Controller;

use App\Entity\Providers;
use App\Entity\Promotions;
use App\Form\PromotionsFormType;
use App\Form\InternshipsFormType;
use App\Repository\ProvidersRepository;
use App\Repository\PromotionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InternshipsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted as Entrée;

class DashboardController extends AbstractController
{
    #[Route('/dashboard/{type}/new', name: 'app_dashboard_add')]
    public function add(
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

        $currentType = $type;

        // On instance le service ou le stage 
        if($type == 'services') {
            $type = 'promotions';
        }
        if($type == 'stages') {
            $type = 'internships';
        }

        $entity = 'App\Entity\\' . ucfirst($type);
        $entity = new $entity;
        
        $newServiceOrStage = 'App\Form\\' . ucfirst($type) . 'FormType';
        $form = $this->createForm($newServiceOrStage, $entity);
        $form->handleRequest($request);
                
        if($form->isSubmitted() && $form->isValid()) {
            $entity->setProviders($provider);
            $entityManager->persist($entity);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_dashboard', ['id' => $provider->getId(), 'type' => $currentType]);
        }

        return $this->render('dashboard/dashboard.html.twig', compact(
            'list_categ',
            'form',
            'currentType'
        ));
    }

    #[Route('/dashboard/{type}/{id}', name: 'app_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function index(
        $type,
        Providers $providers,
        CategoriesOfServicesRepository $categRepository,
        PromotionsRepository $promotionsRepository,
        InternshipsRepository $internshipsRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        if($type == 'services') {
            $listing = $promotionsRepository->findBy(['providers' => $providers->getId()]);
        }
        if($type == 'stages') {
            $listing = $internshipsRepository->findBy(['providers' => $providers->getId()]);
        }
        $currentType = $type;
        
        return $this->render('dashboard/dashboard.html.twig', compact(
            'list_categ',
            'listing',
            'currentType'
        ));
    }

    #[Route('/dashboard/{type}/edit/{id}', name: 'app_dashboard_edit', methods: ['GET', 'POST'])]
    public function edit(
        $id, 
        $type,
        Request $request, 
        PromotionsRepository $promotionsRepository,
        ProvidersRepository $providersRepository,
        InternshipsRepository $internshipsRepository,
        EntityManagerInterface $entityManager,
    ): Response {
        // Récupération de l'utilisateur connecté
        $user = $this->getUser();
        $provider = $user->getProviders()->getId();
        $provider = $providersRepository->findOneBy(['id' => $provider]);

        $currentType = $type;
        if ($type == 'services') {
            $promotions = $promotionsRepository->find($id);
            $form = $this->createForm(PromotionsFormType::class, $promotions);
            $form->handleRequest($request); 
        }
        if ($type == 'stages') {
            $internships = $internshipsRepository->find($id);
            $form = $this->createForm(InternshipsFormType::class, $internships);
            $form->handleRequest($request); 
        }
        // dd($promotions->getProviders()->getId(), $id);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($type == 'services') {
                $promotionsRepository->save($promotions, true);
                $provider->addPromotion($promotions);
            }
            if ($type == 'stages') {
                $internshipsRepository->save($internships, true);
                $provider->addInternship($internships);
            }
            $promotionsRepository->save($promotions, true);
            $provider->addPromotion($promotions);

            $entityManager->persist($provider);
            $entityManager->flush();
            return $this->redirectToRoute('app_dashboard', ['id' => $provider->getId(), 'type' => $currentType], Response::HTTP_SEE_OTHER);
        }
        // dd($id);
        return $this->render('dashboard/dashboard.html.twig', compact(
            'form',
            'currentType'
        ));
    }

    #[Route('/{type}/delete/{id}', name: 'app_dashboard_delete', methods: ['POST'])]
    public function delete(
        $id,
        $type,
        Request $request, 
        PromotionsRepository $promotionsRepository,
        ProvidersRepository $providersRepository,
        InternshipsRepository $internshipsRepository,
    ): Response {
        // Récupération de l'utilisateur connecté
        $user = $this->getUser();
        $provider = $user->getProviders()->getId();
        $provider = $providersRepository->findOneBy(['id' => $provider]);
                
        $currentType = $type;
        if ($type == 'services') {
            $promotions = $promotionsRepository->find($id);
            $form = $this->createForm(PromotionsFormType::class, $promotions);
            $form->handleRequest($request); 
        }
        if ($type == 'stages') {
            $internships = $internshipsRepository->find($id);
            $form = $this->createForm(InternshipsFormType::class, $internships);
            $form->handleRequest($request); 
        }
        
        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            if ($type == 'services') {
                $promotionsRepository->remove($promotions, true);
            }
            if ($type == 'stages') {
                $internshipsRepository->remove($internships, true);
            }
        }
        return $this->redirectToRoute('app_dashboard', ['id' => $provider->getId(), 'type' => $currentType], Response::HTTP_SEE_OTHER);
    }
}
