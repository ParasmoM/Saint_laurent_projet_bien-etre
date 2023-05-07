<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressStreet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adressNumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $registration = null;

    #[ORM\Column(length: 255)]
    private ?string $userType = null;

    #[ORM\Column]
    private ?int $failedAttempts = null;

    #[ORM\Column]
    private ?bool $banned = null;

    #[ORM\Column]
    private ?bool $isVerified = null;

    #[ORM\ManyToOne(inversedBy: 'users', cascade: ["persist"])]
    private ?InternetUsers $internetUsers = null;

    #[ORM\ManyToOne(inversedBy: 'users', cascade: ["persist"])]
    private ?Providers $providers = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Towns $town = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Localities $locality = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?PostalCodes $postalCode = null;

    public function __construct()
    {
        $this->registration = new \DateTime('now');
        $this->failedAttempts = 0;
        $this->banned = false;
        $this->isVerified = false;
        $this->roles = ["ROLE_USER"];
    }

    public function __toString()
    {
        return $this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAddressStreet(): ?string
    {
        return $this->addressStreet;
    }

    public function setAddressStreet(string $addressStreet): self
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    public function getAdressNumber(): ?string
    {
        return $this->adressNumber;
    }

    public function setAdressNumber(string $adressNumber): self
    {
        $this->adressNumber = $adressNumber;

        return $this;
    }

    public function getRegistration(): ?\DateTimeInterface
    {
        return $this->registration;
    }

    public function setRegistration(\DateTimeInterface $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): self
    {
        $this->userType = $userType;

        return $this;
    }

    public function getFailedAttempts(): ?int
    {
        return $this->failedAttempts;
    }

    public function setFailedAttempts(int $failedAttempts): self
    {
        $this->failedAttempts = $failedAttempts;

        return $this;
    }

    public function isBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function getInternetUsers(): ?InternetUsers
    {
        return $this->internetUsers;
    }

    public function setInternetUsers(?InternetUsers $internetUsers): self
    {
        $this->internetUsers = $internetUsers;

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

    public function getTown(): ?Towns
    {
        return $this->town;
    }

    public function setTown(?Towns $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getLocality(): ?Localities
    {
        return $this->locality;
    }

    public function setLocality(?Localities $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getPostalCode(): ?PostalCodes
    {
        return $this->postalCode;
    }

    public function setPostalCode(?PostalCodes $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }
}
