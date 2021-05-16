<?php

namespace App\Entity;

use App\Repository\EnfermedadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnfermedadRepository::class)
 */
class Enfermedad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $nombreE;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="enfermedades")
     */
    private $ficha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreE(): ?string
    {
        return $this->nombreE;
    }

    public function setNombreE(?string $nombreE): self
    {
        $this->nombreE = $nombreE;

        return $this;
    }

    public function getFicha(): ?Ficha
    {
        return $this->ficha;
    }

    public function setFicha(?Ficha $ficha): self
    {
        $this->ficha = $ficha;

        return $this;
    }
}
