<?php

namespace App\Entity;

use App\Repository\FichaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FichaRepository::class)
 */
class Ficha
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esterilizado;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $fallecido;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, mappedBy="ficha", cascade={"persist", "remove"})
     */
    private $animal;

    /**
     * @ORM\OneToMany(targetEntity=Vacuna::class, mappedBy="ficha")
     */
    private $vacunas;

    /**
     * @ORM\OneToMany(targetEntity=Enfermedad::class, mappedBy="ficha")
     */
    private $enfermedades;

    /**
     * @ORM\OneToMany(targetEntity=Revision::class, mappedBy="ficha")
     */
    private $revisiones;

    public function __construct()
    {
        $this->vacunas = new ArrayCollection();
        $this->enfermedades = new ArrayCollection();
        $this->revisiones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEsterilizado(): ?bool
    {
        return $this->esterilizado;
    }

    public function setEsterilizado(?bool $esterilizado): self
    {
        $this->esterilizado = $esterilizado;

        return $this;
    }

    public function getFallecido(): ?bool
    {
        return $this->fallecido;
    }

    public function setFallecido(?bool $fallecido): self
    {
        $this->fallecido = $fallecido;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        // unset the owning side of the relation if necessary
        if ($animal === null && $this->animal !== null) {
            $this->animal->setFicha(null);
        }

        // set the owning side of the relation if necessary
        if ($animal !== null && $animal->getFicha() !== $this) {
            $animal->setFicha($this);
        }

        $this->animal = $animal;

        return $this;
    }

    /**
     * @return Collection|Vacuna[]
     */
    public function getVacunas(): Collection
    {
        return $this->vacunas;
    }

    public function addVacuna(Vacuna $vacuna): self
    {
        if (!$this->vacunas->contains($vacuna)) {
            $this->vacunas[] = $vacuna;
            $vacuna->setFicha($this);
        }

        return $this;
    }

    public function removeVacuna(Vacuna $vacuna): self
    {
        if ($this->vacunas->removeElement($vacuna)) {
            // set the owning side to null (unless already changed)
            if ($vacuna->getFicha() === $this) {
                $vacuna->setFicha(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enfermedad[]
     */
    public function getEnfermedades(): Collection
    {
        return $this->enfermedades;
    }

    public function addEnfermedade(Enfermedad $enfermedade): self
    {
        if (!$this->enfermedades->contains($enfermedade)) {
            $this->enfermedades[] = $enfermedade;
            $enfermedade->setFicha($this);
        }

        return $this;
    }

    public function removeEnfermedade(Enfermedad $enfermedade): self
    {
        if ($this->enfermedades->removeElement($enfermedade)) {
            // set the owning side to null (unless already changed)
            if ($enfermedade->getFicha() === $this) {
                $enfermedade->setFicha(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Revision[]
     */
    public function getRevisiones(): Collection
    {
        return $this->revisiones;
    }

    public function addRevisione(Revision $revisione): self
    {
        if (!$this->revisiones->contains($revisione)) {
            $this->revisiones[] = $revisione;
            $revisione->setFicha($this);
        }

        return $this;
    }

    public function removeRevisione(Revision $revisione): self
    {
        if ($this->revisiones->removeElement($revisione)) {
            // set the owning side to null (unless already changed)
            if ($revisione->getFicha() === $this) {
                $revisione->setFicha(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return (string) $this->getId();
    }
}
