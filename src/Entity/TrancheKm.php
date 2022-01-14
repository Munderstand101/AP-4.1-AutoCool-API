<?php

namespace App\Entity;

use App\Repository\TrancheKmRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrancheKmRepository::class)]
class TrancheKm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'bigint')]
    private $minKm;

    #[ORM\Column(type: 'bigint')]
    private $maxKm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinKm(): ?string
    {
        return $this->minKm;
    }

    public function setMinKm(string $minKm): self
    {
        $this->minKm = $minKm;

        return $this;
    }

    public function getMaxKm(): ?string
    {
        return $this->maxKm;
    }

    public function setMaxKm(string $maxKm): self
    {
        $this->maxKm = $maxKm;

        return $this;
    }
}
