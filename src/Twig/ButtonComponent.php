<?php

namespace App\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ButtonComponent extends AbstractExtension
{
    private $urlGenerator;
    private $csrfTokenManager;

    public function __construct(UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('delete_button', [$this, 'deleteButton'], ['is_safe' => ['html']]),
            new TwigFunction('link_button', [$this, 'linkButton'], ['is_safe' => ['html']]),
        ];
    }

    public function deleteButton($path, int $id, $icone): string
    {
        $url = $this->urlGenerator->generate($path, ['id' => $id]);
        $token = $this->csrfTokenManager->refreshToken('delete' . $id);

        return sprintf(
            '<form action="%s" method="post" onsubmit="return confirm(\'Are you sure you want to delete this item?\');">
                <input type="hidden" name="_token" value="%s">
                <button>%s</button>
            </form>',
            $url,
            $token,
            $icone,
        );
    }

    public function linkButton($path, int $id, $val): string
    {
        $url = $this->urlGenerator->generate($path, ['id' => $id]);

        return sprintf(
            '<a href="%s">%s</a>',
            $url, 
            $val
        );
    }
}
