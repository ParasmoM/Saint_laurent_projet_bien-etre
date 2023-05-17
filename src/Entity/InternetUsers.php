<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\InternetUsersRepository;
use Doctrine\Common\Collections\Collection;
use App\Entity\Traits\FullNameToStringTrait;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: InternetUsersRepository::class)]
class InternetUsers
{
    use FullNameToStringTrait;

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
