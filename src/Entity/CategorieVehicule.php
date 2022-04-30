<?php

namespace App\Entity;

use App\Repository\CategorieVehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: CategorieVehiculeRepository::class)]
class CategorieVehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("read")]
    #[MaxDepth(3)]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    #[MaxDepth(3)]
    private $libelle;

    #[ORM\OneToMany(mappedBy: 'categorieVehicule', targetEntity: TypeVehicule::class)]
    #[MaxDepth(3)]
    private $type;



    public function __construct()
    {
        $this->type = new ArrayCollection();

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

    /**
     * @return Collection|TypeVehicule[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(TypeVehicule $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setCategorieVehicule($this);
        }

        return $this;
    }

    public function removeType(TypeVehicule $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getCategorieVehicule() === $this) {
                $type->setCategorieVehicule(null);
            }
        }

        return $this;
    }


}
