<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ProvidersRepository;
use App\Repository\PromotionsRepository;
use App\Repository\InternshipsRepository;
use App\Repository\InternetUsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['POST', 'GET'])]
    public function index(
        Request $request,
        ContactRepository $contactRepository,
        CategoriesOfServicesRepository $categRepository,
        ProvidersRepository $providersRepository,
        InternetUsersRepository $internetUsersRepository,
        PromotionsRepository $promotionsRepository,
        InternshipsRepository $internshipsRepository
    ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);

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

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);

            $this->addFlash(
                'success',
                'Votre demande a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_contact');
        }
        
        return $this->render('contact/contact.html.twig', compact(
            'list_categ',
            'form',
            'statsTab',
        ));
    }
}
