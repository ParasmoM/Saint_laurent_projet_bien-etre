<?php

namespace App\Controller;

use App\Repository\ProvidersRepository;
use App\Repository\PromotionsRepository;
use App\Repository\InternshipsRepository;
use App\Repository\InternetUsersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutUsController extends AbstractController
{
    #[Route('/about/', name: 'app_about_us')]
    public function index(
        CategoriesOfServicesRepository $categRepository,
        ProvidersRepository $providersRepository,
        InternetUsersRepository $internetUsersRepository,
        PromotionsRepository $promotionsRepository,
        InternshipsRepository $internshipsRepository
    ): Response {
        $list_categ = $categRepository->findAll();

        $statsTab = [];
        $providerCount = count($providersRepository->findAll());
        $internetUserCount = count($internetUsersRepository->findAll());
        $promotionCount = count($promotionsRepository->findAll());
        $internshipCount = count($internshipsRepository->findAll());
        $statsTab['provider'] = ['count' => $providerCount, 'phrase' => 'Nbre de prestataire : '];
        $statsTab['internetUser'] = ['count' => $internetUserCount, 'phrase' => 'Nbre d\'utilisateur : '];
        $statsTab['promotion'] = ['count' => $promotionCount, 'phrase' => 'Nbre de service : '];
        $statsTab['internship'] = ['count' => $internshipCount, 'phrase' => 'Nbre de stage : '];
        return $this->render('about_us/about_us.html.twig', compact(
            'list_categ',
            'statsTab'
        ));
    }
}
