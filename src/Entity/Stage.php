<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StageRepository::class)]
class Stage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titredestage = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptiondestage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedebutstage = null;

    #[ORM\Column(length: 255)]
    private ?string $datefinstage = null;

    #[ORM\Column]
    private ?int $dureedestage = null;

    #[ORM\Column(length: 255)]
    private ?string $lieustage = null;

    #[ORM\OneToMany(mappedBy: 'registrationstage', targetEntity: Registration::class)]
    private Collection $registrationoffre;

    #[ORM\ManyToOne(inversedBy: 'addentreprise')]
    private ?Entreprise $entrepriseadd = null;

    public function __construct()
    {
        $this->registrationoffre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitredestage(): ?string
    {
        return $this->titredestage;
    }

    public function setTitredestage(string $titredestage): static
    {
        $this->titredestage = $titredestage;

        return $this;
    }

    public function getDescriptiondestage(): ?string
    {
        return $this->descriptiondestage;
    }

    public function setDescriptiondestage(string $descriptiondestage): static
    {
        $this->descriptiondestage = $descriptiondestage;

        return $this;
    }

    public function getDatedebutstage(): ?\DateTimeInterface
    {
        return $this->datedebutstage;
    }

    public function setDatedebutstage(\DateTimeInterface $datedebutstage): static
    {
        $this->datedebutstage = $datedebutstage;

        return $this;
    }

    public function getDatefinstage(): ?string
    {
        return $this->datefinstage;
    }

    public function setDatefinstage(string $datefinstage): static
    {
        $this->datefinstage = $datefinstage;

        return $this;
    }

    public function getDureedestage(): ?int
    {
        return $this->dureedestage;
    }

    public function setDureedestage(int $dureedestage): static
    {
        $this->dureedestage = $dureedestage;

        return $this;
    }

    public function getLieustage(): ?string
    {
        return $this->lieustage;
    }

    public function setLieustage(string $lieustage): static
    {
        $this->lieustage = $lieustage;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrationoffre(): Collection
    {
        return $this->registrationoffre;
    }

    public function addRegistrationoffre(Registration $registrationoffre): static
    {
        if (!$this->registrationoffre->contains($registrationoffre)) {
            $this->registrationoffre->add($registrationoffre);
            $registrationoffre->setRegistrationstage($this);
        }

        return $this;
    }

    public function removeRegistrationoffre(Registration $registrationoffre): static
    {
        if ($this->registrationoffre->removeElement($registrationoffre)) {
            // set the owning side to null (unless already changed)
            if ($registrationoffre->getRegistrationstage() === $this) {
                $registrationoffre->setRegistrationstage(null);
            }
        }

        return $this;
    }

    public function getEntrepriseadd(): ?Entreprise
    {
        return $this->entrepriseadd;
    }

    public function setEntrepriseadd(?Entreprise $entrepriseadd): static
    {
        $this->entrepriseadd = $entrepriseadd;

        return $this;
    }
}
