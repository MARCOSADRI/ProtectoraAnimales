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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motivo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diagnostico;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="revisions")
     */
    private $ficha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotivo(): ?string
    {
        return $this->motivo;
    }

    public function setMotivo(?string $motivo): self
    {
        $this->motivo = $motivo;

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
