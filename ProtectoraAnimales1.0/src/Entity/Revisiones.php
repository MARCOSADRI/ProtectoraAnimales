<?php

namespace App\Entity;

use App\Repository\RevisionesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RevisionesRepository::class)
 */
class Revisiones
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $diagnostico;

    /**
     * @ORM\ManyToOne(targetEntity=ficha::class, inversedBy="revisiones")
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

    public function getFicha(): ?ficha
    {
        return $this->ficha;
    }

    public function setFicha(?ficha $ficha): self
    {
        $this->ficha = $ficha;

        return $this;
    }
}
