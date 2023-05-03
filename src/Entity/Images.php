<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $orderNumber = null;

    #[ORM\OneToOne(inversedBy: 'images', cascade: ['persist', 'remove'])]
    private ?CategoriesOfServices $serviceImage = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Providers $providerLogo = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Providers $providerPhoto = null;

    public function __toString()
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

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
}
