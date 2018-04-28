<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PieceRepository")
 */
class Piece
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Etage", inversedBy="pieces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etage;

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

    public function getEtage(): ?Etage
    {
        return $this->etage;
    }

    public function setEtage(?Etage $etage): self
    {
        $this->etage = $etage;

        return $this;
    }
}
