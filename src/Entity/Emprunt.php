<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateEmprunt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateRetour = null;

    #[ORM\Column(nullable: true)]
    private ?float $penalite = null;

    #[ORM\ManyToOne(targetEntity: Bibliothecaire::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bibliothecaire $bibliothecaire = null;

    #[ORM\ManyToOne(targetEntity: Adherent::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adherent $adherent = null;

    #[ORM\Column(length: 50)]
    private ?string $etat = 'en_cours';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTime
    {
        return $this->dateEmprunt;
    }

    public function setDateEmprunt(\DateTime $dateEmprunt): static
    {
        $this->dateEmprunt = $dateEmprunt;
        return $this;
    }

    public function getDateRetour(): ?\DateTime
    {
        return $this->dateRetour;
    }

    public function setDateRetour(?\DateTime $dateRetour): static
    {
        $this->dateRetour = $dateRetour;
        return $this;
    }

    public function getPenalite(): ?float
    {
        return $this->penalite;
    }

    public function setPenalite(?float $penalite): static
    {
        $this->penalite = $penalite;
        return $this;
    }

    public function getBibliothecaire(): ?Bibliothecaire
    {
        return $this->bibliothecaire;
    }

    public function setBibliothecaire(?Bibliothecaire $bibliothecaire): static
    {
        $this->bibliothecaire = $bibliothecaire;
        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): static
    {
        $this->adherent = $adherent;
        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;
        return $this;
    }
}
