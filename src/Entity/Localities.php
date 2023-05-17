<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\NameToStringTrait;
use App\Repository\LocalitiesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: LocalitiesRepository::class)]
class Localities
{
    use NameToStringTrait;

    #[ORM\OneToMany(mappedBy: 'locality', targetEntity: Users::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
            $user->setLocality($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLocality() === $this) {
                $user->setLocality(null);
            }
        }

        return $this;
    }
}
