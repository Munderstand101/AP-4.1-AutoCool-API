<?php

namespace App\Entity;

use App\Repository\FormuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormuleRepository::class)]
class Formule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $fraisAdhesion;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $tarifMensuel;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $partSociale;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $depotGarantie;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $caution;

    #[ORM\OneToMany(mappedBy: 'formule', targetEntity: Abonne::class)]
    private $abonnes;


    public function __construct()
    {
        $this->abonnes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle): void
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getFraisAdhesion()
    {
        return $this->fraisAdhesion;
    }

    /**
     * @param mixed $fraisAdhesion
     */
    public function setFraisAdhesion($fraisAdhesion): void
    {
        $this->fraisAdhesion = $fraisAdhesion;
    }

    /**
     * @return mixed
     */
    public function getTarifMensuel()
    {
        return $this->tarifMensuel;
    }

    /**
     * @param mixed $tarifMensuel
     */
    public function setTarifMensuel($tarifMensuel): void
    {
        $this->tarifMensuel = $tarifMensuel;
    }

    /**
     * @return mixed
     */
    public function getPartSociale()
    {
        return $this->partSociale;
    }

    /**
     * @param mixed $partSociale
     */
    public function setPartSociale($partSociale): void
    {
        $this->partSociale = $partSociale;
    }

    /**
     * @return mixed
     */
    public function getDepotGarantie()
    {
        return $this->depotGarantie;
    }

    /**
     * @param mixed $depotGarantie
     */
    public function setDepotGarantie($depotGarantie): void
    {
        $this->depotGarantie = $depotGarantie;
    }

    /**
     * @return mixed
     */
    public function getCaution()
    {
        return $this->caution;
    }

    /**
     * @param mixed $caution
     */
    public function setCaution($caution): void
    {
        $this->caution = $caution;
    }

    /**
     * @return Collection|Abonne[]
     */
    public function getAbonnes(): Collection
    {
        return $this->abonnes;
    }

    public function addAbonne(Abonne $abonne): self
    {
        if (!$this->abonnes->contains($abonne)) {
            $this->abonnes[] = $abonne;
            $abonne->setFormule($this);
        }

        return $this;
    }

    public function removeAbonne(Abonne $abonne): self
    {
        if ($this->abonnes->removeElement($abonne)) {
            // set the owning side to null (unless already changed)
            if ($abonne->getFormule() === $this) {
                $abonne->setFormule(null);
            }
        }

        return $this;
    }

}
