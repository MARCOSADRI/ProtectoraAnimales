<?php

namespace App\Entity;

use App\Repository\RevisionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RevisionRepository::class)
 */
class Revision
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diagnostico;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="revisiones")
     */
    private $ficha;

    /**
     * @ORM\ManyToOne(targetEntity=Enfermedad::class, inversedBy="revisions")
     */
    private $enfermedad;

    /**
     * @ORM\ManyToOne(targetEntity=Vacuna::class, inversedBy="revisions")
     */
    private $vacuna;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getDiagnostico(): ?string
    {
        return $this->diagnostico;
    }

    public function setDiagnostico(?string $diagnostico): self
    {
        $this->diagnostico = $diagnostico;

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

    public function getEnfermedad(): ?Enfermedad
    {
        return $this->enfermedad;
    }

    public function setEnfermedad(?Enfermedad $enfermedad): self
    {
        $this->enfermedad = $enfermedad;

        return $this;
    }

    public function getVacuna(): ?Vacuna
    {
        return $this->vacuna;
    }

    public function setVacuna(?Vacuna $vacuna): self
    {
        $this->vacuna = $vacuna;

        return $this;
    }
}
