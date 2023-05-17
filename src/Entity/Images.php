<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImagesRepository;
use App\Entity\Traits\NameToStringTrait;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    use NameToStringTrait;

    #[ORM\Column(nullable: true)]
    private ?int $orderNumber = null;

    #[ORM\OneToOne(inversedBy: 'images', cascade: ['persist', 'remove'])]
    private ?CategoriesOfServices $serviceImage = null;

    #[ORM\OneToOne(targetEntity: Providers::class, inversedBy: 'providerLogo')]
    private ?Providers $providerLogo = null;

    #[ORM\OneToOne(targetEntity: Providers::class, inversedBy: 'providerPhoto')]
    private ?Providers $providerPhoto = null;

    #[ORM\OneToOne(inversedBy: 'images', cascade: ['persist', 'remove'])]
    private ?InternetUsers $internetUser = null;

    #[ORM\ManyToOne(inversedBy: 'gallery')]
    private ?Providers $providers = null;

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getServiceImage(): ?CategoriesOfServices
    {
        return $this->serviceImage;
    }

    public function setServiceImage(?CategoriesOfServices $serviceImage): self
    {
        $this->serviceImage = $serviceImage;

        return $this;
    }

    public function getInternetUser(): ?InternetUsers
    {
        return $this->internetUser;
    }

    public function setInternetUser(?InternetUsers $internetUser): self
    {
        $this->internetUser = $internetUser;

        return $this;
    }

    public function getProviderLogo(): ?Providers
    {
        return $this->providerLogo;
    }

    public function setProviderLogo(?Providers $providerLogo): self
    {
        $this->providerLogo = $providerLogo;

        return $this;
    }

    public function getProviderPhoto(): ?Providers
    {
        return $this->providerPhoto;
    }

    public function setProviderPhoto(?Providers $providerPhoto): self
    {
        $this->providerPhoto = $providerPhoto;

        return $this;
    }

    public function getProviders(): ?Providers
    {
        return $this->providers;
    }

    public function setProviders(?Providers $providers): self
    {
        $this->providers = $providers;

        return $this;
    }
}
