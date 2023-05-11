<?php

namespace App\Entity;

use App\Repository\InternetUsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InternetUsersRepository::class)]
class InternetUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?bool $newsletter = null;

    #[ORM\OneToMany(mappedBy: 'internetUsers', targetEntity: Users::class)]
    private Collection $users;

    #[ORM\OneToOne(mappedBy: 'internetUser', cascade: ['persist', 'remove'])]
    private ?Images $images = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function isNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

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
            $user->setInternetUsers($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getInternetUsers() === $this) {
                $user->setInternetUsers(null);
            }
        }

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
            $this->images->setInternetUser(null);
        }

        // set the owning side of the relation if necessary
        if ($images !== null && $images->getInternetUser() !== $this) {
            $images->setInternetUser($this);
        }

        $this->images = $images;

        return $this;
    }
}
