<?php

namespace App\Entity;

use App\Repository\TypeVehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeVehiculeRepository::class)]
class TypeVehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\ManyToOne(targetEntity: CategorieVehicule::class, inversedBy: 'type')]
    private $categorieVehicule;

    #[ORM\OneToMany(mappedBy: 'typeVehicule', targetEntity: Vehicule::class)]
    private $vehicule;

    public function __construct()
    {
        $this->vehicule = new ArrayCollection();
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

    /**
     * @return Collection|Vehicule[]
     */
    public function getVehicule(): Collection
    {
        return $this->vehicule;
    }

    public function addVehicule(Vehicule $vehicule): self
    {
        if (!$this->vehicule->contains($vehicule)) {
            $this->vehicule[] = $vehicule;
            $vehicule->setTypeVehicule($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicule->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getTypeVehicule() === $this) {
                $vehicule->setTypeVehicule(null);
            }
        }

        return $this;
    }
}
