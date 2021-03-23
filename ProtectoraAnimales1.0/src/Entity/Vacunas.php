<?php

namespace App\Entity;

use App\Repository\VacunasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacunasRepository::class)
 */
class Vacunas
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
    private $nombreV;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $previene;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $fabricante;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="vacunas")
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

    public function getNombreV(): ?string
    {
        return $this->nombreV;
    }

    public function setNombreV(?string $nombreV): self
    {
        $this->nombreV = $nombreV;

        return $this;
    }

    public function getPreviene(): ?string
    {
        return $this->previene;
    }

    public function setPreviene(?string $previene): self
    {
        $this->previene = $previene;

        return $this;
    }

    public function getFabricante(): ?string
    {
        return $this->fabricante;
    }

    public function setFabricante(?string $fabricante): self
    {
        $this->fabricante = $fabricante;

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
