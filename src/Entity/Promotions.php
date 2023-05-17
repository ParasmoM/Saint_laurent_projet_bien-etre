<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\DateRangeTrait;
use App\Entity\Traits\NameToStringTrait;
use App\Repository\PromotionsRepository;
use App\Validator\Constraints as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PromotionsRepository::class)]
/**
 * @CustomAssert\IsEndDateValid
 * @CustomAssert\IsDisplayUntilDateValid
 */
class Promotions
{
    use NameToStringTrait;
    use DateRangeTrait;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documentPdf = null;

    #[ORM\ManyToOne(inversedBy: 'promotion')]
    private ?Providers $providers = null;

    #[ORM\ManyToOne(inversedBy: 'promotions')]
    #[Assert\NotNull(message: "Le service ne peut pas être null.")]
    private ?CategoriesOfServices $service = null;

    public function __construct()
    {
        $this->start_date = new \DateTime();
    }

    public function getDocumentPdf(): ?string
    {
        return $this->documentPdf;
    }

    public function setDocumentPdf(string $documentPdf): self
    {
        $this->documentPdf = $documentPdf;

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

    public function getService(): ?CategoriesOfServices
    {
        return $this->service;
    }

    public function setService(?CategoriesOfServices $service): self
    {
        $this->service = $service;

        return $this;
    }
}
