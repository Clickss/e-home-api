<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtatRepository")
 */
class Etat
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
    private $lib_etat_oui;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lib_etat_non;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $val_slider;
    
    public function __construct()
    {
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLib_etat_oui(): ?string
    {
        return $this->nom;
    }

    public function setLib_etat_oui(string $lib_etat_oui): self
    {
        $this->lib_etat_oui = $lib_etat_oui;

        return $this;
    }

    public function getLib_etat_non(): ?string
    {
        return $this->lib_etat_non;
    }

    public function setLib_etat_non(string $lib_etat_non): self
    {
        $this->lib_etat_non = $lib_etat_non;

        return $this;
    }

    public function getVal_slider(): ?string
    {
        return $this->val_slider;
    }

    public function setVal_slider(string $val_slider): self
    {
        $this->val_slider = $val_slider;

        return $this;
    }
}
