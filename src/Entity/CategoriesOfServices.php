<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\NameToStringTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\CategoriesOfServicesRepository;

#[ORM\Entity(repositoryClass: CategoriesOfServicesRepository::class)]
class CategoriesOfServices
{
    use NameToStringTrait;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $featured = null;

    #[ORM\Column(nullable: true)]
    private ?bool $validated = null;

    #[ORM\OneToOne(mappedBy: 'serviceImage', cascade: ['persist', 'remove'])]
    private ?Images $images = null;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Promotions::class)]
    private Collection $promotions;

    public function __construct()
    {
        $this->promotions = new ArrayCollection();
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

    public function isFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    public function isValidated(): ?bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): self
    {
        $this->validated = $validated;

        return $this;
    }

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): self
    {
        // unset the owning side of the relation if necessary
        if ($images === null && $this->images !== null) {
            $this->images->setServiceImage(null);
        }

        // set the owning side of the relation if necessary
        if ($images !== null && $images->getServiceImage() !== $this) {
            $images->setServiceImage($this);
        }

        $this->images = $images;

        return $this;
    }

    /**
     * @return Collection<int, Promotions>
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotions $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions->add($promotion);
            $promotion->setService($this);
        }

        return $this;
    }

    public function removePromotion(Promotions $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getService() === $this) {
                $promotion->setService(null);
            }
        }

        return $this;
    }
}
