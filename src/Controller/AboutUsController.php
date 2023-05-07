<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutUsController extends AbstractController
{
    #[Route('/about/', name: 'app_about_us')]
    public function index(
        CategoriesOfServicesRepository $categRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        return $this->render('about_us/about_us.html.twig', compact(
            'list_categ'
        ));
    }
}
