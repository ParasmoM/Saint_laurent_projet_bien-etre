<?php

namespace App\Twig;


use Twig\TwigFunction;
use Symfony\Component\Asset\Packages;
use Twig\Extension\AbstractExtension;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProfileImageComponent extends AbstractExtension
{
    private $urlGenerator;
    private $packages;

    public function __construct(
        Packages $packages,
        UrlGeneratorInterface $urlGenerator,
    ) {
        $this->packages = $packages;
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('avatar_component', [$this, 'avatarComponent'], ['is_safe' => ['html']]),
        ];
    }

    public function avatarComponent($name_image, $provider, $path): string
    {
        if ($path) {
            $path = $this->urlGenerator->generate('app_providers_profile', ['id' => $provider->getId()]);
        } else {
            $path = '';
        }
        
        if ($name_image) {
            $imgSrc = $this->packages->getUrl('assets/uploads/providers/' . $name_image);
            $path = $this->urlGenerator->generate('app_providers_profile', ['id' => $provider->getId()]);
            return '<a href="' . $path . '"><img src="' . $imgSrc . '" alt=""></a>';
        } else {
            return '<a href="' . $path . '"><span>' . strtoupper(substr($provider, 0, 1)) . '</span></a>';
        }
    }
}
