<?php

namespace App\Entity;

use App\Repository\VacunaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacunaRepository::class)
 */
class Vacuna
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
    private $nombreV;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $previene;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $fabricante;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="vacunas")
     */
    private $ficha;

    /**
     * @ORM\OneToMany(targetEntity=Revision::class, mappedBy="vacuna")
     */
    private $revisions;

    public function __construct()
    {
        $this->revisions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $revision->setVacuna($this);
        }

        return $this;
    }

    public function removeRevision(Revision $revision): self
    {
        if ($this->revisions->removeElement($revision)) {
            // set the owning side to null (unless already changed)
            if ($revision->getVacuna() === $this) {
                $revision->setVacuna(null);
            }
        }

        return $this;
    }
}
