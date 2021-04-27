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
    private $estado;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, mappedBy="ficha", cascade={"persist", "remove"})
     */
    private $animal;

    /**
     * @ORM\OneToMany(targetEntity=Vacuna::class, mappedBy="ficha")
     */
    private $vacunas;

    /**
     * @ORM\OneToMany(targetEntity=Revision::class, mappedBy="ficha")
     */
    private $revisions;

    /**
     * @ORM\OneToMany(targetEntity=Enfermedad::class, mappedBy="ficha")
     */
    private $enfermedads;

    public function __construct()
    {
        $this->vacunas = new ArrayCollection();
        $this->revisions = new ArrayCollection();
        $this->enfermedads = new ArrayCollection();
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

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): self
    {
        $this->estado = $estado;

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
     * @return Collection|Revision[]
     */
    public function getRevisions(): Collection
    {
        return $this->revisions;
    }

    public function addRevision(Revision $revision): self
    {
        if (!$this->revisions->contains($revision)) {
            $this->revisions[] = $revision;
            $revision->setFicha($this);
        }

        return $this;
    }

    public function removeRevision(Revision $revision): self
    {
        if ($this->revisions->removeElement($revision)) {
            // set the owning side to null (unless already changed)
            if ($revision->getFicha() === $this) {
                $revision->setFicha(null);
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
