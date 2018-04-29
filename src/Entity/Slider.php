<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SliderRepository")
 */
class Slider
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
    private $lib_slider;

    /**
     * @ORM\Column(type="integer")
     */
    private $min_slider;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_slider;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unite_slider;

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

    public function getLib_slider(): ?string
    {
        return $this->lib_slider;
    }

    public function setLib_lider(string $lib_slider): self
    {
        $this->lib_slider = $lib_slider;

        return $this;
    }

    public function getMin_slider(): ?int
    {
        return $this->min_slider;
    }

    public function setMin_slider(int $min_slider): self
    {
        $this->min_slider = $min_slider;

        return $this;
    }

    public function getMax_slider(): ?int
    {
        return $this->max_slider;
    }

    public function setMax_slider(int $max_slider): self
    {
        $this->max_slider = $max_slider;

        return $this;
    }

    public function getUnite_slider(): ?string
    {
        return $this->unite_slider;
    }

    public function setUnite_slider(string $unite_slider): self
    {
        $this->unite_slider = $unite_slider;

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
