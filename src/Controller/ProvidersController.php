<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use App\Repository\ProvidersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProvidersController extends AbstractController
{
    #[Route('/providers', name: 'app_providers', methods: ['GET'])]
    public function index(
        Request $request,
        CategoriesOfServicesRepository $categRepository,
        ProvidersRepository $providersRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        // Récupérez le numéro de la page à partir de la requête, utilisez 1 par défaut si aucune page n'est fournie
        $page = $request->query->get('page', 1);

        // On récupère les prestataires paginer en fonction du filtre 
        $providers = $providersRepository->findByProviders($_GET, $page);

        return $this->render('providers/index.html.twig', compact(
            'list_categ',
            'providers',
        ));
    }
}
