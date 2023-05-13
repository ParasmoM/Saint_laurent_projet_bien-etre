<?php

namespace App\Entity;

use App\Repository\PromotionsRepository;
use App\Validator\Constraints as CustomAssert;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PromotionsRepository::class)]
/**
 * @CustomAssert\IsEndDateValid
 * @CustomAssert\IsDisplayUntilDateValid
 */
class Promotions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documentPdf = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $display_from_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $display_until_date = null;

    #[ORM\ManyToOne(inversedBy: 'promotion')]
    private ?Providers $providers = null;

    #[ORM\ManyToOne(inversedBy: 'promotions')]
    #[Assert\NotNull(message: "Le service ne peut pas être null.")]
    private ?CategoriesOfServices $service = null;

    public function __construct()
    {
        $this->start_date = new \DateTime();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getDisplayFromDate(): ?\DateTimeInterface
    {
        return $this->display_from_date;
    }

    public function setDisplayFromDate(\DateTimeInterface $display_from_date): self
    {
        $this->display_from_date = $display_from_date;

        return $this;
    }

    public function getDisplayUntilDate(): ?\DateTimeInterface
    {
        return $this->display_until_date;
    }

    public function setDisplayUntilDate(\DateTimeInterface $display_until_date): self
    {
        $this->display_until_date = $display_until_date;

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
