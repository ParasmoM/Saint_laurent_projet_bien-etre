<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\ImagesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use App\Repository\ProvidersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        CategoriesOfServicesRepository $categRepository,
        ImagesRepository $imagesRepository,
        ProvidersRepository $providersRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        $image_gallery = $imagesRepository->findBy(['serviceImage' => null, 'providerLogo' => null, 'providerPhoto' => null]);

        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $new_providers = $providersRepository->findBy([], ['id' => 'DESC'], 4);

        return $this->render('home/home.html.twig', compact(
            'list_categ',
            'image_gallery',
            'form',
            'new_providers'
        ));
    }
}
