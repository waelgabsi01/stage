<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomdelentreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $secteur = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'nameentreprise', targetEntity: Offres::class)]
    private Collection $nameentreprise;

    #[ORM\OneToMany(mappedBy: 'entrepriseadd', targetEntity: Stage::class)]
    private Collection $addentreprise;

    public function __construct()
    {
        $this->nameentreprise = new ArrayCollection();
        $this->addentreprise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomdelentreprise(): ?string
    {
        return $this->nomdelentreprise;
    }

    public function setNomdelentreprise(string $nomdelentreprise): static
    {
        $this->nomdelentreprise = $nomdelentreprise;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Offres>
     */
    public function getNameentreprise(): Collection
    {
        return $this->nameentreprise;
    }

    public function addNameentreprise(Offres $nameentreprise): static
    {
        if (!$this->nameentreprise->contains($nameentreprise)) {
            $this->nameentreprise->add($nameentreprise);
            $nameentreprise->setNameentreprise($this);
        }

        return $this;
    }

    public function removeNameentreprise(Offres $nameentreprise): static
    {
        if ($this->nameentreprise->removeElement($nameentreprise)) {
            // set the owning side to null (unless already changed)
            if ($nameentreprise->getNameentreprise() === $this) {
                $nameentreprise->setNameentreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stage>
     */
    public function getAddentreprise(): Collection
    {
        return $this->addentreprise;
    }

    public function addAddentreprise(Stage $addentreprise): static
    {
        if (!$this->addentreprise->contains($addentreprise)) {
            $this->addentreprise->add($addentreprise);
            $addentreprise->setEntrepriseadd($this);
        }

        return $this;
    }

    public function removeAddentreprise(Stage $addentreprise): static
    {
        if ($this->addentreprise->removeElement($addentreprise)) {
            // set the owning side to null (unless already changed)
            if ($addentreprise->getEntrepriseadd() === $this) {
                $addentreprise->setEntrepriseadd(null);
            }
        }

        return $this;
    }
}
