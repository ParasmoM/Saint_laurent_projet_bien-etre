<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(
        CategoriesOfServicesRepository $categRepository
    ): Response {
        $list_categ = $categRepository->findAll();

        return $this->render('services/service.html.twig', compact(
            'list_categ'
        ));
    }
}
