<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
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
    private $nombreA;

    /**
     * @ORM\ManyToOne(targetEntity=Tamano::class, inversedBy="animals")
     */
    private $tamano;

    /**
     * @ORM\ManyToOne(targetEntity=Raza::class, inversedBy="animals")
     */
    private $raza;

    /**
     * @ORM\ManyToOne(targetEntity=Especie::class, inversedBy="animals")
     */
    private $especie;

    /**
     * @ORM\OneToOne(targetEntity=Ficha::class, inversedBy="animal", cascade={"persist", "remove"})
     */
    private $ficha;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="animals")
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $sexo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $edad;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTamano(): ?Tamano
    {
        return $this->tamano;
    }

    public function setTamano(?Tamano $tamano): self
    {
        $this->tamano = $tamano;

        return $this;
    }

    public function getRaza(): ?Raza
    {
        return $this->raza;
    }

    public function setRaza(?Raza $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getEspecie(): ?Especie
    {
        return $this->especie;
    }

    public function setEspecie(?Especie $especie): self
    {
        $this->especie = $especie;

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

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

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

    public function __toString(){
        return (string) $this->getId();
    }
}
