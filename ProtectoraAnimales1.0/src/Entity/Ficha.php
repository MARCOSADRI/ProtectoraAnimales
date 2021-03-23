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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $animal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $historial;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esterilizado;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @ORM\OneToOne(targetEntity=Animales::class, mappedBy="ficha", cascade={"persist", "remove"})
     */
    private $animales;

    /**
     * @ORM\OneToMany(targetEntity=Revisiones::class, mappedBy="ficha")
     */
    private $revisiones;

    /**
     * @ORM\OneToMany(targetEntity=Vacunas::class, mappedBy="ficha")
     */
    private $vacunas;

    /**
     * @ORM\OneToMany(targetEntity=Enfermedad::class, mappedBy="ficha")
     */
    private $enfermedads;

    public function __construct()
    {
        $this->revisiones = new ArrayCollection();
        $this->vacunas = new ArrayCollection();
        $this->enfermedads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimal(): ?int
    {
        return $this->animal;
    }

    public function setAnimal(?int $animal): self
    {
        $this->animal = $animal;

        return $this;
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

    public function getEsterilizado(): ?bool
    {
        return $this->esterilizado;
    }

    public function setEsterilizado(?bool $esterilizado): self
    {
        $this->esterilizado = $esterilizado;

        return $this;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getAnimales(): ?Animales
    {
        return $this->animales;
    }

    public function setAnimales(?Animales $animales): self
    {
        // unset the owning side of the relation if necessary
        if ($animales === null && $this->animales !== null) {
            $this->animales->setFicha(null);
        }

        // set the owning side of the relation if necessary
        if ($animales !== null && $animales->getFicha() !== $this) {
            $animales->setFicha($this);
        }

        $this->animales = $animales;

        return $this;
    }

    /**
     * @return Collection|Revisiones[]
     */
    public function getRevisiones(): Collection
    {
        return $this->revisiones;
    }

    public function addRevisione(Revisiones $revisione): self
    {
        if (!$this->revisiones->contains($revisione)) {
            $this->revisiones[] = $revisione;
            $revisione->setFicha($this);
        }

        return $this;
    }

    public function removeRevisione(Revisiones $revisione): self
    {
        if ($this->revisiones->removeElement($revisione)) {
            // set the owning side to null (unless already changed)
            if ($revisione->getFicha() === $this) {
                $revisione->setFicha(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vacunas[]
     */
    public function getVacunas(): Collection
    {
        return $this->vacunas;
    }

    public function addVacuna(Vacunas $vacuna): self
    {
        if (!$this->vacunas->contains($vacuna)) {
            $this->vacunas[] = $vacuna;
            $vacuna->setFicha($this);
        }

        return $this;
    }

    public function removeVacuna(Vacunas $vacuna): self
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
    public function getEnfermedads(): Collection
    {
        return $this->enfermedads;
    }

    public function addEnfermedad(Enfermedad $enfermedad): self
    {
        if (!$this->enfermedads->contains($enfermedad)) {
            $this->enfermedads[] = $enfermedad;
            $enfermedad->setFicha($this);
        }

        return $this;
    }

    public function removeEnfermedad(Enfermedad $enfermedad): self
    {
        if ($this->enfermedads->removeElement($enfermedad)) {
            // set the owning side to null (unless already changed)
            if ($enfermedad->getFicha() === $this) {
                $enfermedad->setFicha(null);
            }
        }

        return $this;
    }
}
