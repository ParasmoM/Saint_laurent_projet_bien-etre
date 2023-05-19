<?php

namespace App\Controller;

use App\Entity\Promotions;
use App\Entity\CategoriesOfServices;
use App\Repository\ProvidersRepository;
use App\Repository\PromotionsRepository;
use App\Repository\InternshipsRepository;
use App\Repository\InternetUsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services_defaut')]
    public function default(
        CategoriesOfServicesRepository $categRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        return $this->redirectToRoute('app_services', ['id' => $list_categ[0]->getId()]);
    }

    #[Route('/services/{id}', name: 'app_services', methods: ['GET'])]
    public function index(
        $id, 
        Request $request,
        CategoriesOfServices $serviceCurrent,
        CategoriesOfServicesRepository $categRepository,
        ProvidersRepository $providersRepository,
        InternetUsersRepository $internetUsersRepository,
        PromotionsRepository $promotionsRepository,
        InternshipsRepository $internshipsRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        $services = $promotionsRepository->findBycateg($id, $request->query->getInt('page', 1));

        $statsTab = [];
        
        $providerCount = count($providersRepository->findAll());
        $internetUserCount = count($internetUsersRepository->findAll());
        $promotionCount = count($promotionsRepository->findAll());
        $internshipCount = count($internshipsRepository->findAll());
        $statsTab['provider'] = ['count' => $providerCount, 'phrase' => 'Nbre de prestataire : '];
        $statsTab['internetUser'] = ['count' => $internetUserCount, 'phrase' => 'Nbre d\'utilisateur : '];
        $statsTab['promotion'] = ['count' => $promotionCount, 'phrase' => 'Nbre de service : '];
        $statsTab['internship'] = ['count' => $internshipCount, 'phrase' => 'Nbre de stage : '];
        
        return $this->render('services/service.html.twig', compact(
            'list_categ',
            'serviceCurrent',
            'services',
            'statsTab'
        ));
    }

    #[Route('/services/description/{id}', name: 'app_services_description')]
    public function description(
        Request $request,
        Promotions $promotions,
        CategoriesOfServicesRepository $categRepository,
        ProvidersRepository $providersRepository,
        InternetUsersRepository $internetUsersRepository,
        PromotionsRepository $promotionsRepository,
        InternshipsRepository $internshipsRepository,
    ): Response {
        $list_categ = $categRepository->findAll();
        
        // Récupérez le numéro de la page à partir de la requête, utilisez 1 par défaut si aucune page n'est fournie
        $page = $request->query->get('page', 1);

        $service = $promotions->getService()->getName();
        $providers = $providersRepository->findByProviders($service, $page);
        // dd($providers);

        $statsTab = [];
        
        $providerCount = count($providersRepository->findAll());
        $internetUserCount = count($internetUsersRepository->findAll());
        $promotionCount = count($promotionsRepository->findAll());
        $internshipCount = count($internshipsRepository->findAll());
        $statsTab['provider'] = ['count' => $providerCount, 'phrase' => 'Nbre de prestataire : '];
        $statsTab['internetUser'] = ['count' => $internetUserCount, 'phrase' => 'Nbre d\'utilisateur : '];
        $statsTab['promotion'] = ['count' => $promotionCount, 'phrase' => 'Nbre de service : '];
        $statsTab['internship'] = ['count' => $internshipCount, 'phrase' => 'Nbre de stage : '];
        return $this->render('services/service-description.html.twig', compact(
            'list_categ',
            'promotions',
            'providers',
            'statsTab'
        ));
    }
}
