<?php

namespace App\Entity;

use App\Repository\AbonneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonneRepository::class)]
class Abonne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'datetime')]
    private $dateNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    private $rue;

    #[ORM\Column(type: 'string', length: 255)]
    private $ville;

    #[ORM\Column(type: 'string', length: 255)]
    private $codePostal;

    #[ORM\Column(type: 'string', length: 255)]
    private $tel;

    #[ORM\Column(type: 'string', length: 255)]
    private $telMobile;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $numPermis;

    #[ORM\Column(type: 'string', length: 255)]
    private $lieuPermis;

    #[ORM\Column(type: 'string', length: 255)]
    private $datePermis;

    #[ORM\Column(type: 'string', length: 255)]
    private $paiementAdhesion;

    #[ORM\Column(type: 'string', length: 255)]
    private $paiementCaution;

    #[ORM\Column(type: 'string', length: 255)]
    private $ribFourni;

    #[ORM\ManyToOne(targetEntity: Formule::class, inversedBy: 'abonnes')]
    private $formule;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getTelMobile(): ?string
    {
        return $this->telMobile;
    }

    public function setTelMobile(string $telMobile): self
    {
        $this->telMobile = $telMobile;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumPermis(): ?string
    {
        return $this->numPermis;
    }

    public function setNumPermis(string $numPermis): self
    {
        $this->numPermis = $numPermis;

        return $this;
    }

    public function getLieuPermis(): ?string
    {
        return $this->lieuPermis;
    }

    public function setLieuPermis(string $lieuPermis): self
    {
        $this->lieuPermis = $lieuPermis;

        return $this;
    }

    public function getDatePermis(): ?string
    {
        return $this->datePermis;
    }

    public function setDatePermis(string $datePermis): self
    {
        $this->datePermis = $datePermis;

        return $this;
    }

    public function getPaiementAdhesion(): ?string
    {
        return $this->paiementAdhesion;
    }

    public function setPaiementAdhesion(string $paiementAdhesion): self
    {
        $this->paiementAdhesion = $paiementAdhesion;

        return $this;
    }

    public function getPaiementCaution(): ?string
    {
        return $this->paiementCaution;
    }

    public function setPaiementCaution(string $paiementCaution): self
    {
        $this->paiementCaution = $paiementCaution;

        return $this;
    }

    public function getRibFourni(): ?string
    {
        return $this->ribFourni;
    }

    public function setRibFourni(string $ribFourni): self
    {
        $this->ribFourni = $ribFourni;

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


}
