<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\DateRangeTrait;
use App\Entity\Traits\NameToStringTrait;
use App\Repository\InternshipsRepository;
use App\Validator\Constraints as CustomAssert;

#[ORM\Entity(repositoryClass: InternshipsRepository::class)]
/**
 * @CustomAssert\IsEndDateValid
 * @CustomAssert\IsDisplayUntilDateValid
 */
class Internships
{
    use NameToStringTrait;
    use DateRangeTrait;

    #[ORM\Column(length: 255)]
    private ?string $rate = null;

    #[ORM\Column(length: 255)]
    private ?string $additionalInformation = null;

    #[ORM\ManyToOne(inversedBy: 'internship')]
    private ?Providers $providers = null;
    
    public function __construct()
    {
        $this->start_date = new \DateTime();
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getAdditionalInformation(): ?string
    {
        return $this->additionalInformation;
    }

    public function setAdditionalInformation(string $additionalInformation): self
    {
        $this->additionalInformation = $additionalInformation;

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
