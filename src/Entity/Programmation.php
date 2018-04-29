<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgrammationRepository")
 */
class Programmation
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
    private $heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objet", inversedBy="programmations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Programmation", mappedBy="attribut_objet", orphanRemoval=true)
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

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getJour(): ?Jour
    {
        return $this->jour;
    }

    public function setJour(?Jour $jour): self
    {
        $this->jour = $jour;

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
