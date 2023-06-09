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
use App\Repository\InternetUsersRepository;
use App\Repository\InternshipsRepository;
use App\Repository\PromotionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        ImagesRepository $imagesRepository,
        CategoriesOfServicesRepository $categRepository,
        ProvidersRepository $providersRepository,
        InternetUsersRepository $internetUsersRepository,
        PromotionsRepository $promotionsRepository,
        InternshipsRepository $internshipsRepository
    ): Response {
        $list_categ = $categRepository->findAll();

        $error = null;
        if ($_GET) {
            $error = $_GET['error'];

            $this->addFlash(
                'errors', 
                $error
            );
        }

        $image_gallery = $imagesRepository->findBy(['serviceImage' => null, 'providerLogo' => null, 'providerPhoto' => null]);

        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $new_providers = $providersRepository->findBy([], ['id' => 'DESC'], 4);

        $statsTab = [];
        
        $providerCount = count($providersRepository->findAll());
        $internetUserCount = count($internetUsersRepository->findAll());
        $promotionCount = count($promotionsRepository->findAll());
        $internshipCount = count($internshipsRepository->findAll());
        $statsTab['provider'] = ['count' => $providerCount, 'phrase' => 'Nbre de prestataire : '];
        $statsTab['internetUser'] = ['count' => $internetUserCount, 'phrase' => 'Nbre d\'utilisateur : '];
        $statsTab['promotion'] = ['count' => $promotionCount, 'phrase' => 'Nbre de service : '];
        $statsTab['internship'] = ['count' => $internshipCount, 'phrase' => 'Nbre de stage : '];
        
        return $this->render('home/home.html.twig', compact(
            'list_categ',
            'image_gallery',
            'form',
            'new_providers',
            'error',
            'statsTab'
        ));
    }

    #[Route('/newsletter', name: 'app_home_newsletter', methods: ['POST'])]
    public function newsletterAction(
        Request $request,
        UsersRepository $usersRepository,
        EntityManagerInterface $entityManager,
        InternetUsersRepository $internetUsersRepository,
    ): Response {
        $userCurrent = $this->getUser();
        $newsletterEmail = $request->request->get('newsletterEmail');
        $user = $usersRepository->findOneBy(['email' => $newsletterEmail]);
        
        if ($userCurrent->getId() != null && $user != null) {
            if ($userCurrent->getId() == $user->getId()) {
                $userId = $user->getInternetUsers()->getId();
                $internetUser = $internetUsersRepository->findOneBy(['id' => $userId]);
                $internetUser->setNewsletter(1);
                $internetUsersRepository->save($internetUser, true);
                // dd($internetUser);
                $this->addFlash('success', "Vous vous êtes inscrit(e) à la newsletter avec succès.");
                return $this->redirectToRoute('app_home');
            }
        }
        $this->addFlash('success', "Adresse e-mail invalide.");
        return $this->redirectToRoute('app_home');
    }
}
