<?php

namespace App\Entity;

use App\Repository\FactureHRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureHRepository::class)]
class FactureH
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $tarifH;

    #[ORM\OneToOne(targetEntity: Formule::class, cascade: ['persist', 'remove'])]
    private $formule;

    #[ORM\OneToOne(targetEntity: TrancheHoraire::class, cascade: ['persist', 'remove'])]
    private $trancheHoraire;

    #[ORM\OneToOne(targetEntity: CategorieVehicule::class, cascade: ['persist', 'remove'])]
    private $categorieVehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifH(): ?float
    {
        return $this->tarifH;
    }

    public function setTarifH(float $tarifH): self
    {
        $this->tarifH = $tarifH;

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

    public function getTrancheHoraire(): ?TrancheHoraire
    {
        return $this->trancheHoraire;
    }

    public function setTrancheHoraire(?TrancheHoraire $trancheHoraire): self
    {
        $this->trancheHoraire = $trancheHoraire;

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
