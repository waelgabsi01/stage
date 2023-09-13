<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateregistration = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'registrationoffre')]
    private ?Stage $registrationstage = null;

    #[ORM\ManyToOne(inversedBy: 'registrationstage')]
    private ?Offres $registoffre = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateregistration(): ?\DateTimeInterface
    {
        return $this->dateregistration;
    }

    public function setDateregistration(\DateTimeInterface $dateregistration): static
    {
        $this->dateregistration = $dateregistration;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getRegistrationstage(): ?Stage
    {
        return $this->registrationstage;
    }

    public function setRegistrationstage(?Stage $registrationstage): static
    {
        $this->registrationstage = $registrationstage;

        return $this;
    }

    public function getRegistoffre(): ?Offres
    {
        return $this->registoffre;
    }

    public function setRegistoffre(?Offres $registoffre): static
    {
        $this->registoffre = $registoffre;

        return $this;
    }
}
