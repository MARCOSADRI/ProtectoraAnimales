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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nombreEnfermedad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diagnosticoEnfermedad;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="enfermedads")
     */
    private $ficha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEnfermedad(): ?string
    {
        return $this->nombreEnfermedad;
    }

    public function setNombreEnfermedad(?string $nombreEnfermedad): self
    {
        $this->nombreEnfermedad = $nombreEnfermedad;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getDiagnosticoEnfermedad(): ?string
    {
        return $this->diagnosticoEnfermedad;
    }

    public function setDiagnosticoEnfermedad(?string $diagnosticoEnfermedad): self
    {
        $this->diagnosticoEnfermedad = $diagnosticoEnfermedad;

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
