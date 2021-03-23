<?php

namespace App\Entity;

use App\Repository\AnimalesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalesRepository::class)
 */
class Animales
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $especie;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $raza;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tamano;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nombreA;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="user")
     */
    private $adoptador;

    /**
     * @ORM\OneToOne(targetEntity=Ficha::class, inversedBy="animales", cascade={"persist", "remove"})
     */
    private $ficha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspecie(): ?string
    {
        return $this->especie;
    }

    public function setEspecie(?string $especie): self
    {
        $this->especie = $especie;

        return $this;
    }

    public function getRaza(): ?string
    {
        return $this->raza;
    }

    public function setRaza(?string $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getTamano(): ?string
    {
        return $this->tamano;
    }

    public function setTamano(?string $tamano): self
    {
        $this->tamano = $tamano;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getNombreA(): ?string
    {
        return $this->nombreA;
    }

    public function setNombreA(?string $nombreA): self
    {
        $this->nombreA = $nombreA;

        return $this;
    }

    public function getAdoptador(): ?user
    {
        return $this->adoptador;
    }

    public function setAdoptador(?user $adoptador): self
    {
        $this->adoptador = $adoptador;

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
