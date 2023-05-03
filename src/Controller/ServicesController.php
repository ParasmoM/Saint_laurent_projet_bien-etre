<?php

namespace App\Controller;

use App\Entity\CategoriesOfServices;
use App\Repository\PromotionsRepository;
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
        PromotionsRepository $promotionRepository
    ): Response {
        $list_categ = $categRepository->findAll();

        $services = $promotionRepository->findBycateg($id, $request->query->getInt('page', 1));

        return $this->render('services/service.html.twig', compact(
            'list_categ',
            'serviceCurrent',
            'services'
        ));
    }

}
