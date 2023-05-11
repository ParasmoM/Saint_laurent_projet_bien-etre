<?php

namespace App\Controller;

use App\Entity\Users;
use App\Security\EmailVerifier;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register/{status}', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(
        $status, 
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager,
        CategoriesOfServicesRepository $categRepository
    ): Response {
        
        $list_categ = $categRepository->findAll();

        $user = new Users();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user, [
            'attr' => [
                'class' => 'form-internaute'
            ]
        ]);
        $registrationForm->handleRequest($request);

        // On crée l'instance en fonction du status 
        $class = ucfirst($status);
        $className = 'App\Entity\\' . $class;
        $utilisateur = new $className();

        // On crée le formulaire en fonction du status 
        $type = $class . 'FormType';
        $formType = 'App\Form\\' . $type;
        $utilisateurForm = $this->createForm($formType, $utilisateur, [
            'attr' => [
                'class' => 'form-' . $status,
            ]
        ]);
        $utilisateurForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid() && $utilisateurForm->isSubmitted() && $utilisateurForm->isValid()) {
            $methodName = 'set' . $class;
            if ($class == 'Providers') {
                $user->setRoles(['ROLE_USER', 'ROLE_PROVIDER']);
            }
            // encode the plain password
            $user
                ->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $registrationForm->get('plainPassword')->getData()
                    )
                )
                ->setUserType($class)
                ->$methodName($utilisateur)
            ;

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('parasmomarco@hotmail.com', 'Parasmo'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', compact(
            // 'categories', 
            'status',
            'registrationForm',
            'utilisateurForm',
            'list_categ'
        ));
    }

    #[Route('/resend-confirmation', name: 'app_resend_confirmation', methods: ['GET'])]
    public function resendConfirmationEmail(EmailVerifier $emailVerifier): Response
    {
        $user = $this->getUser();

        if ($user && !$user->isVerified()) {
            $emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('parasmomarco@hotmail.com', 'Parasmo'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            $this->addFlash('success', 'Un nouvel email de confirmation a été envoyé à votre adresse e-mail.');
        }

        return $this->redirectToRoute('app_home');
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UsersRepository $usersRepository): Response
    {
        $id = $request->get('id');
        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }
        
        $user = $usersRepository->find($id);
        
        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }
        
        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));
            
            return $this->redirectToRoute('app_register');
        }
        
        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_home');
    }
}
