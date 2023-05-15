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
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted as Entrée;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DashboardController extends AbstractController
{
    #[Route('/dashboard/download/{id}', name: 'app_dashboard_download', methods: ['POST', 'GET'])]
    #[IsGranted('ROLE_PROVIDER')]
    public function downloadAction (
        Request $request,
        Promotions $promotions,
        ParameterBagInterface $parameterBagInterface
    ): Response {
        $fileName = $promotions->getDocumentPdf();
        $filePath = $parameterBagInterface->get('image_directory') . 'pdf/' . $fileName;
    
        $response = new BinaryFileResponse($filePath);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $fileName
        );
    
        return $response;
    }

    #[Route('/dashboard/{type}/new', name: 'app_dashboard_add')]
    #[IsGranted('ROLE_PROVIDER')]
    public function add(
        $type,
        Request $request,
        CategoriesOfServicesRepository $categRepository,
        EntityManagerInterface $entityManager,
        ProvidersRepository $providersRepository,
    ): Response {
        // Récupère l'utilisateur actuellement connecté
        $currentUser = $this->getUser();

        $provider = $currentUser->getProviders();
        // dd($provider);
        $list_categ = $categRepository->findAll();

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
    #[IsGranted('ROLE_PROVIDER')]
    // #[Security("is_granted('ROLE_PROVIDER') and user === currentUser")]
    public function index(
        $type,
        Providers $providers,
        CategoriesOfServicesRepository $categRepository,
        PromotionsRepository $promotionsRepository,
        InternshipsRepository $internshipsRepository,
    ): Response {
        // Récupère l'utilisateur actuellement connecté
        $currentUser = $this->getUser();
        // dd($providers->getUsers());
        $error = null;

        // Vérifie si l'utilisateur connecté est le même que celui associé au fournisseur
        if ($currentUser->getProviders()->getId() != $providers->getId()) {
            $error = ('Vous n\'êtes pas autorisé à accéder à ce tableau de bord.');
        }

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
            'currentType',
            'error'
        ));
    }

    #[Route('/dashboard/{type}/edit/{id}', name: 'app_dashboard_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_PROVIDER')]
    public function edit(
        $id, 
        $type,
        Request $request, 
        PromotionsRepository $promotionsRepository,
        ProvidersRepository $providersRepository,
        InternshipsRepository $internshipsRepository,
        EntityManagerInterface $entityManager,
        ParameterBagInterface $parameterBagInterface
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
            // Récupérer le fichier téléchargé
            $file = $form->get('documentPdf')->getData();

            if ($type == 'services') {
                if ($file) {
                    $newFileName = $provider->getFirstName() . '-' . $provider->getLastName() . '-' . $type . '-' . $promotions->getName() .'.pdf';
                    $file->move($parameterBagInterface->get('image_directory') .'pdf/', $newFileName);
                    $promotions->setDocumentPdf($newFileName);
                }
                $promotionsRepository->save($promotions, true);
                $provider->addPromotion($promotions);

            }
            if ($type == 'stages') {
                $internshipsRepository->save($internships, true);
                $provider->addInternship($internships);
            }

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

    #[Route('/dashboard/{type}/delete/{id}', name: 'app_dashboard_delete', methods: ['POST'])]
    #[IsGranted('ROLE_PROVIDER')]
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
