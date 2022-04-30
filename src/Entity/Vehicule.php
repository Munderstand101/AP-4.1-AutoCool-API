<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("read")]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $libelle;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $kilometrage;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $niveau_essence;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $nb_place;

    #[ORM\Column(type: 'boolean')]
    #[Groups("read")]
    private $estAutomatique;

    #[ORM\ManyToOne(targetEntity: TypeVehicule::class, inversedBy: 'vehicule')]
    #[Groups("read")]
//    #[MaxDepth(1)]
    private $typeVehicule;

    #[ORM\ManyToOne(targetEntity: Lieu::class, inversedBy: 'vehicule')]
    #[Groups("read")]
//    #[MaxDepth(1)]
    private $lieu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getKilometrage(): ?string
    {
        return $this->kilometrage;
    }

    public function setKilometrage(string $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getNiveauEssence(): ?string
    {
        return $this->niveau_essence;
    }

    public function setNiveauEssence(string $niveau_essence): self
    {
        $this->niveau_essence = $niveau_essence;

        return $this;
    }

    public function getNbPlace(): ?string
    {
        return $this->nb_place;
    }

    public function setNbPlace(string $nb_place): self
    {
        $this->nb_place = $nb_place;

        return $this;
    }

    public function getEstAutomatique(): ?bool
    {
        return $this->estAutomatique;
    }

    public function setEstAutomatique(bool $estAutomatique): self
    {
        $this->estAutomatique = $estAutomatique;

        return $this;
    }

    public function getTypeVehicule(): ?TypeVehicule
    {
        return $this->typeVehicule;
    }

    public function setTypeVehicule(?TypeVehicule $typeVehicule): self
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }
}
