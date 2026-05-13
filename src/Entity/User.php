<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Adherent::class)]
    private ?Adherent $adherent = null;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Bibliothecaire::class)]
    private ?Bibliothecaire $bibliothecaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): static
    {
        // unset the owning side of the relation if necessary
        if ($adherent === null && $this->adherent !== null) {
            $this->adherent->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($adherent !== null && $adherent->getUser() !== $this) {
            $adherent->setUser($this);
        }

        $this->adherent = $adherent;

        return $this;
    }

    public function getBibliothecaire(): ?Bibliothecaire
    {
        return $this->bibliothecaire;
    }

    public function setBibliothecaire(?Bibliothecaire $bibliothecaire): static
    {
        // unset the owning side of the relation if necessary
        if ($bibliothecaire === null && $this->bibliothecaire !== null) {
            $this->bibliothecaire->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($bibliothecaire !== null && $bibliothecaire->getUser() !== $this) {
            $bibliothecaire->setUser($this);
        }

        $this->bibliothecaire = $bibliothecaire;

        return $this;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }
}
