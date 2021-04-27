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
     * @ORM\Column(type="string", length=100)
     */
    private $nombreAnimal;

    /**
     * @ORM\ManyToOne(targetEntity=Raza::class, inversedBy="animals")
     */
    private $raza;

    /**
     * @ORM\ManyToOne(targetEntity=Especie::class, inversedBy="animals")
     */
    private $especie;

    /**
     * @ORM\ManyToOne(targetEntity=Tamano::class, inversedBy="animals")
     */
    private $tamano;

    /**
     * @ORM\OneToOne(targetEntity=Ficha::class, inversedBy="animal", cascade={"persist", "remove"})
     */
    private $ficha;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="animals")
     */
    private $adoptador;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreAnimal(): ?string
    {
        return $this->nombreAnimal;
    }

    public function setNombreAnimal(string $nombreAnimal): self
    {
        $this->nombreAnimal = $nombreAnimal;

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

    public function getTamano(): ?Tamano
    {
        return $this->tamano;
    }

    public function setTamano(?Tamano $tamano): self
    {
        $this->tamano = $tamano;

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

    public function getAdoptador(): ?User
    {
        return $this->adoptador;
    }

    public function setAdoptador(?User $adoptador): self
    {
        $this->adoptador = $adoptador;

        return $this;
    }
}
