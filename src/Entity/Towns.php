<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TownsRepository;
use App\Entity\Traits\NameToStringTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TownsRepository::class)]
class Towns
{
    use NameToStringTrait;

    #[ORM\OneToMany(mappedBy: 'town', targetEntity: Users::class)]
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
            $user->setTown($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTown() === $this) {
                $user->setTown(null);
            }
        }

        return $this;
    }
}
