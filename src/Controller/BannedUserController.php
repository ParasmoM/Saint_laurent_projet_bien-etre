<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BannedUserController extends AbstractController
{
    #[Route('/banned/user', name: 'app_banned_user')]
    public function index(): Response
    {
        return $this->render('banned_user/index.html.twig', [
            'controller_name' => 'BannedUserController',
        ]);
    }
}
