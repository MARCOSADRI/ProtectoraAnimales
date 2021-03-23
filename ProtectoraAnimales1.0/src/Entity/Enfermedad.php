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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $historial;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $enfermedad;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="enfermedads")
     */
    private $ficha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHistorial(): ?int
    {
        return $this->historial;
    }

    public function setHistorial(?int $historial): self
    {
        $this->historial = $historial;

        return $this;
    }

    public function getEnfermedad(): ?string
    {
        return $this->enfermedad;
    }

    public function setEnfermedad(?string $enfermedad): self
    {
        $this->enfermedad = $enfermedad;

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
