<?php

namespace App\Entity;

use App\Repository\ProvidersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProvidersRepository::class)]
class Providers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tvaNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $websiteUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagram = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $twitter = null;

    #[ORM\OneToMany(mappedBy: 'providers', targetEntity: Users::class)]
    private Collection $users;

    #[ORM\OneToOne(targetEntity: Images::class, mappedBy: 'providerLogo')]
    private ?Images $providerLogo = null;

    #[ORM\OneToOne(targetEntity: Images::class, mappedBy: 'providerPhoto')]
    private ?Images $providerPhoto = null;

    #[ORM\OneToMany(mappedBy: 'providers', targetEntity: Promotions::class)]
    private Collection $promotion;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'providers', targetEntity: Internships::class)]
    private Collection $internship;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->promotion = new ArrayCollection();
        $this->internship = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getTvaNumber(): ?string
    {
        return $this->tvaNumber;
    }

    public function setTvaNumber(string $tvaNumber): self
    {
        $this->tvaNumber = $tvaNumber;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(string $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProviderLogo(): ?Images
    {
        return $this->providerLogo;
    }

    public function setProviderLogo(?Images $providerLogo): self
    {
        // Set the owning side of the relation if necessary
        if ($providerLogo !== null && $providerLogo->getProviderLogo() !== $this) {
            $providerLogo->setProviderLogo($this);
        }

        $this->providerLogo = $providerLogo;

        return $this;
    }

    public function getProviderPhoto(): ?Images
    {
        return $this->providerPhoto;
    }

    public function setProviderPhoto(?Images $providerPhoto): self
    {
        // Set the owning side of the relation if necessary
        if ($providerPhoto !== null && $providerPhoto->getProviderPhoto() !== $this) {
            $providerPhoto->setProviderPhoto($this);
        }

        $this->providerPhoto = $providerPhoto;

        return $this;
    }
    
    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setProviders($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProviders() === $this) {
                $user->setProviders(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Promotions>
     */
    public function getPromotion(): Collection
    {
        return $this->promotion;
    }

    public function addPromotion(Promotions $promotion): self
    {
        if (!$this->promotion->contains($promotion)) {
            $this->promotion->add($promotion);
            $promotion->setProviders($this);
        }

        return $this;
    }

    public function removePromotion(Promotions $promotion): self
    {
        if ($this->promotion->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getProviders() === $this) {
                $promotion->setProviders(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Internships>
     */
    public function getInternship(): Collection
    {
        return $this->internship;
    }

    public function addInternship(Internships $internship): self
    {
        if (!$this->internship->contains($internship)) {
            $this->internship->add($internship);
            $internship->setProviders($this);
        }

        return $this;
    }

    public function removeInternship(Internships $internship): self
    {
        if ($this->internship->removeElement($internship)) {
            // set the owning side to null (unless already changed)
            if ($internship->getProviders() === $this) {
                $internship->setProviders(null);
            }
        }

        return $this;
    }
}
