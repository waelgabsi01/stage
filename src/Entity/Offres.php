<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffresRepository::class)]
class Offres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $anneesexperience = null;

    #[ORM\Column(length: 255)]
    private ?string $offrename = null;

    #[ORM\Column(length: 255)]
    private ?string $connaisance = null;

    #[ORM\Column(length: 255)]
    private ?string $critere = null;

    #[ORM\Column]
    private ?int $experiencerequise = null;

    #[ORM\Column(length: 255)]
    private ?string $formation = null;

    #[ORM\Column(length: 255)]
    private ?string $langue = null;

    #[ORM\Column(length: 255)]
    private ?string $mission = null;

    #[ORM\Column]
    private ?int $onmbres_recruteur = null;

    #[ORM\Column]
    private ?float $salaire = null;

    #[ORM\Column(length: 255)]
    private ?string $specialite = null;

    #[ORM\Column(length: 255)]
    private ?string $tacheprincipale = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'registoffre', targetEntity: Registration::class)]
    private Collection $registrationstage;

    #[ORM\ManyToOne(inversedBy: 'nameentreprise')]
    private ?Entreprise $nameentreprise = null;

    public function __construct()
    {
        $this->registrationstage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneesexperience(): ?int
    {
        return $this->anneesexperience;
    }

    public function setAnneesexperience(int $anneesexperience): static
    {
        $this->anneesexperience = $anneesexperience;

        return $this;
    }

    public function getOffrename(): ?string
    {
        return $this->offrename;
    }

    public function setOffrename(string $offrename): static
    {
        $this->offrename = $offrename;

        return $this;
    }

    public function getConnaisance(): ?string
    {
        return $this->connaisance;
    }

    public function setConnaisance(string $connaisance): static
    {
        $this->connaisance = $connaisance;

        return $this;
    }

    public function getCritere(): ?string
    {
        return $this->critere;
    }

    public function setCritere(string $critere): static
    {
        $this->critere = $critere;

        return $this;
    }

    public function getExperiencerequise(): ?int
    {
        return $this->experiencerequise;
    }

    public function setExperiencerequise(int $experiencerequise): static
    {
        $this->experiencerequise = $experiencerequise;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): static
    {
        $this->mission = $mission;

        return $this;
    }

    public function getOnmbresRecruteur(): ?int
    {
        return $this->onmbres_recruteur;
    }

    public function setOnmbresRecruteur(int $onmbres_recruteur): static
    {
        $this->onmbres_recruteur = $onmbres_recruteur;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): static
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getTacheprincipale(): ?string
    {
        return $this->tacheprincipale;
    }

    public function setTacheprincipale(string $tacheprincipale): static
    {
        $this->tacheprincipale = $tacheprincipale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrationstage(): Collection
    {
        return $this->registrationstage;
    }

    public function addRegistrationstage(Registration $registrationstage): static
    {
        if (!$this->registrationstage->contains($registrationstage)) {
            $this->registrationstage->add($registrationstage);
            $registrationstage->setRegistoffre($this);
        }

        return $this;
    }

    public function removeRegistrationstage(Registration $registrationstage): static
    {
        if ($this->registrationstage->removeElement($registrationstage)) {
            // set the owning side to null (unless already changed)
            if ($registrationstage->getRegistoffre() === $this) {
                $registrationstage->setRegistoffre(null);
            }
        }

        return $this;
    }

    public function getNameentreprise(): ?Entreprise
    {
        return $this->nameentreprise;
    }

    public function setNameentreprise(?Entreprise $nameentreprise): static
    {
        $this->nameentreprise = $nameentreprise;

        return $this;
    }
}
