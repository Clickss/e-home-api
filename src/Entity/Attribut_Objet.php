<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Attribut_ObjetRepository")
 */
class Attribut_Objet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Slider", inversedBy="attribbut_objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $slider;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="attribut_objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objet", mappedBy="attribut_objet", orphanRemoval=true)
     */
    private $objets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Programmation", mappedBy="attribut_objet", orphanRemoval=true)
     */
    private $programmations;

    public function __construct()
    {
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSlider(): ?Slider
    {
        return $this->slider;
    }

    public function setSlider(?Slider $slider): self
    {
        $this->slider = $slider;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCouleur(): ?Couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|Objet[]
     */
    public function getObjets(): Collection
    {
        return $this->objets;
    }

    public function addObjet(Objet $objet): self
    {
        if (!$this->objets->contains($objet)) {
            $this->objets[] = $objet;
            $piece->setAttribut_Objet($this);
        }

        return $this;
    }

    public function removeObjet(Piece $objet): self
    {
        if ($this->objets->contains($objet)) {
            $this->objets->removeElement($objet);
            // set the owning side to null (unless already changed)
            if ($piece->getAtribut_Objet() === $this) {
                $piece->setAttribut_Objet(null);
            }
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
            $piece->setAtribut_Objet($this);
        }

        return $this;
    }

    public function removeProgrammation(Programmation $programmation): self
    {
        if ($this->programmations->contains($programmation)) {
            $this->programmations->removeElement($programmation);
            // set the owning side to null (unless already changed)
            if ($piece->getAtribut_Objet() === $this) {
                $piece->setAtribut_Objet(null);
            }
        }

        return $this;
    }
}
