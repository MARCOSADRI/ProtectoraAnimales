<?php

namespace App\Entity;

use App\Repository\EnfermedadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnfermedadRepository::class)
 */
class Enfermedad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $nombreE;

    /**
     * @ORM\ManyToOne(targetEntity=Ficha::class, inversedBy="enfermedades")
     */
    private $ficha;

    /**
     * @ORM\OneToMany(targetEntity=Revision::class, mappedBy="enfermedad")
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

    public function getNombreE(): ?string
    {
        return $this->nombreE;
    }

    public function setNombreE(?string $nombreE): self
    {
        $this->nombreE = $nombreE;

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
            $revision->setEnfermedad($this);
        }

        return $this;
    }

    public function removeRevision(Revision $revision): self
    {
        if ($this->revisions->removeElement($revision)) {
            // set the owning side to null (unless already changed)
            if ($revision->getEnfermedad() === $this) {
                $revision->setEnfermedad(null);
            }
        }

        return $this;
    }
}
