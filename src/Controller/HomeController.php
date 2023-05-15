<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\UsersRepository;
use App\Repository\ImagesRepository;
use App\Repository\ProvidersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        CategoriesOfServicesRepository $categRepository,
        ImagesRepository $imagesRepository,
        ProvidersRepository $providersRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        $error = null;
        if ($_GET) {
            $error = $_GET['error'];
        }

        $image_gallery = $imagesRepository->findBy(['serviceImage' => null, 'providerLogo' => null, 'providerPhoto' => null]);

        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $new_providers = $providersRepository->findBy([], ['id' => 'DESC'], 4);

        return $this->render('home/home.html.twig', compact(
            'list_categ',
            'image_gallery',
            'form',
            'new_providers',
            'error'
        ));
    }

    #[Route('/newsletter', name: 'app_home_newsletter', methods: ['POST'])]
    public function newsletterAction(
        Request $request,
        UsersRepository $usersRepository,
        EntityManagerInterface $entityManager,
    ): Response {
        dd("here");
        $newsletterEmail = $request->request->get('newsletterEmail');

        $user = $usersRepository->findOneBy(['email' => $newsletterEmail]);
        $user = $user->getInternetUsers();
        $user->setNewsletter(true);
        $entityManager->persist($user);
        $entityManager->flush();
        

        return $this->redirectToRoute('app_home');
    }
}
