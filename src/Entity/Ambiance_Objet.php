<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ambiance_ObjetRepository")
 */
class Ambiance_Objet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objet", inversedBy="ambiance_objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ambiance", inversedBy="ambiance_objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ambiance;

    public function __construct()
    {
        
    }

    public function getId()
    {
        return $this->id;
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

    public function getAmbiance(): ?Ambiance
    {
        return $this->ambiance;
    }

    public function setAmbiance(?Ambiance $ambiance): self
    {
        $this->ambiance = $ambiance;

        return $this;
    }
}
