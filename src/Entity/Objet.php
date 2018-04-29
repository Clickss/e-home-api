<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjetRepository")
 */
class Objet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Piece", inversedBy="objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $piece;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objet", mappedBy="attribut_objet", orphanRemoval=true)
     */
    private $attribut_Objet;

    public function __construct()
    {
        $this->attribut_objet = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getAttribut_Objet(): ?Attribut_Objet
    {
        return $this->attribut_Objet;
    }

    public function setAttribut_Objet(?Attribut_Objet $attribut_Objet): self
    {
        $this->attribut_Objet = $attribut_Objet;

        return $this;
    }
}
