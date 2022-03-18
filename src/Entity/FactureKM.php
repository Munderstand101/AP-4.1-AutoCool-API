<?php

namespace App\Entity;

use App\Repository\FactureKMRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureKMRepository::class)]
class FactureKM
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $tarifKM;

    #[ORM\OneToOne(targetEntity: Formule::class, cascade: ['persist', 'remove'])]
    private $formule;

    #[ORM\OneToOne(targetEntity: TrancheKm::class, cascade: ['persist', 'remove'])]
    private $trancheKM;

    #[ORM\OneToOne(targetEntity: CategorieVehicule::class, cascade: ['persist', 'remove'])]
    private $categorieVehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifKM(): ?float
    {
        return $this->tarifKM;
    }

    public function setTarifKM(float $tarifKM): self
    {
        $this->tarifKM = $tarifKM;

        return $this;
    }

    public function getFormule(): ?Formule
    {
        return $this->formule;
    }

    public function setFormule(?Formule $formule): self
    {
        $this->formule = $formule;

        return $this;
    }

    public function getTrancheKM(): ?TrancheKm
    {
        return $this->trancheKM;
    }

    public function setTrancheKM(?TrancheKm $trancheKM): self
    {
        $this->trancheKM = $trancheKM;

        return $this;
    }

    public function getCategorieVehicule(): ?CategorieVehicule
    {
        return $this->categorieVehicule;
    }

    public function setCategorieVehicule(?CategorieVehicule $categorieVehicule): self
    {
        $this->categorieVehicule = $categorieVehicule;

        return $this;
    }
}
