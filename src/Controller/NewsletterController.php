<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(
        CategoriesOfServicesRepository $categRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        return $this->render('newsletter/newsletter.html.twig', compact(
            'list_categ',
        ));
    }
}
