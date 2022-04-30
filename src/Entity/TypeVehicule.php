<?php

namespace App\Entity;

use App\Repository\TypeVehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypeVehiculeRepository::class)]
class TypeVehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("read")]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $libelle;

    #[ORM\ManyToOne(targetEntity: CategorieVehicule::class, inversedBy: 'type')]
    #[Groups("read")]
    private $categorieVehicule;



    public function __construct()
    {

    }

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
