<?php

namespace App\Security;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;

class UserAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;
    private UsersRepository $userRepository;
    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator, UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function onAuthenticationFailure(
        Request $request, 
        AuthenticationException $exception
    ): Response {
        
        $email = $request->request->get('email', '');
        $user = $this->userRepository->findOneByEmail($email);
        
        $error = null;

        if ($user == null) {
            $error = "Malheureusement, le compte que vous recherchez n'existe pas dans notre système.";
            return new RedirectResponse($this->urlGenerator->generate('app_home', ['error' => $error]));
        }

        if (!$user->isBanned()) {
            $nbr = $user->getFailedAttempts();

            if ($nbr <= 2) {
                $user->setFailedAttempts(++$nbr);

                if ($nbr === 3) {
                    $user->setBanned(true);
                }
            }

            $this->userRepository->save($user, true);
            $nbr = 3 - $user->getFailedAttempts();
            
            if ($nbr > 0) {
                if ($nbr == 1) {
                    $error = "Soyez vigilant, vous n'avez plus que une tentative restante.";
                } else {
                    $error = "Soyez vigilant, vous n'avez plus que " . $nbr . " tentatives restantes.";
                }
                return new RedirectResponse($this->urlGenerator->generate('app_home', ['error' => $error]));
            }
        }
        
        if ($user->isBanned()) {
            $error = "Malheureusement, ce compte a été banni. Veuillez contacter un modérateur pour obtenir plus d'informations.";
            return new RedirectResponse($this->urlGenerator->generate('app_home', ['error' => $error]));
        }

        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');
        
        // Récupérer l'utilisateur
        $user = $this->userRepository->findOneByEmail($email);
    
        // Vérifier si l'utilisateur est banni
        if ($user && $user->isBanned()) {
            throw new AuthenticationException("Votre compte a été banni.");
        }
        
        if ($user != null) {
            $user->setFailedAttempts(0);
            $this->userRepository->save($user, true);
        }
        
        $request->getSession()->set(Security::LAST_USERNAME, $email);
    
        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }
    

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // For example:
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
        // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
