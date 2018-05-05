<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjetPieceRepository")
 */
class ObjetPiece
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Piece", inversedBy="objetPieces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $piece;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objet", inversedBy="objetPieces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objet;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ambiance", inversedBy="objetPieces")
     */
    private $ambiances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Programmation", mappedBy="objet_piece", orphanRemoval=true)
     */
    private $programmations;

    public function __construct()
    {
        $this->ambiances = new ArrayCollection();
        $this->programmations = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function setPiece(?Piece $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getObjet(): ?Objet
    {
        return $this->objet;
    }

    public function setObjet(?Objet $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * @return Collection|Ambiance[]
     */
    public function getAmbiances(): Collection
    {
        return $this->ambiances;
    }

    public function addAmbiance(Ambiance $ambiance): self
    {
        if (!$this->ambiances->contains($ambiance)) {
            $this->ambiances[] = $ambiance;
        }

        return $this;
    }

    public function removeAmbiance(Ambiance $ambiance): self
    {
        if ($this->ambiances->contains($ambiance)) {
            $this->ambiances->removeElement($ambiance);
        }

        return $this;
    }

    /**
     * @return Collection|Programmation[]
     */
    public function getProgrammations(): Collection
    {
        return $this->programmations;
    }

    public function addProgrammation(Programmation $programmation): self
    {
        if (!$this->programmations->contains($programmation)) {
            $this->programmations[] = $programmation;
            $programmation->setObjetPiece($this);
        }

        return $this;
    }

    public function removeProgrammation(Programmation $programmation): self
    {
        if ($this->programmations->contains($programmation)) {
            $this->programmations->removeElement($programmation);
            // set the owning side to null (unless already changed)
            if ($programmation->getObjetPiece() === $this) {
                $programmation->setObjetPiece(null);
            }
        }

        return $this;
    }
}