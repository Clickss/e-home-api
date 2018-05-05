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
     * @ORM\Column(type="string", length=10)
     */
    private $unite_slider;
    /**
     * @ORM\Column(type="integer")
     */
    private $val_min_slider;
    /**
     * @ORM\Column(type="integer")
     */
    private $val_max_slider;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AttributObjet", mappedBy="slider")
     */
    private $attributObjets;
    public function __construct()
    {
        $this->attributObjets = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getLibSlider(): ?string
    {
        return $this->lib_slider;
    }
    public function setLibSlider(string $lib_slider): self
    {
        $this->lib_slider = $lib_slider;
        return $this;
    }
    public function getMinSlider(): ?int
    {
        return $this->min_slider;
    }
    public function setMinSlider(int $min_slider): self
    {
        $this->min_slider = $min_slider;
        return $this;
    }
    public function getMaxSlider(): ?int
    {
        return $this->max_slider;
    }
    public function setMaxSlider(int $max_slider): self
    {
        $this->max_slider = $max_slider;
        return $this;
    }
    public function getUniteSlider(): ?string
    {
        return $this->unite_slider;
    }
    public function setUniteSlider(string $unite_slider): self
    {
        $this->unite_slider = $unite_slider;
        return $this;
    }
    public function getValMinSlider(): ?int
    {
        return $this->val_min_slider;
    }
    public function setValMinSlider(int $val_min_slider): self
    {
        $this->val_min_slider = $val_min_slider;
        return $this;
    }
    public function getValMaxSlider(): ?int
    {
        return $this->val_max_slider;
    }
    public function setValMaxSlider(int $val_max_slider): self
    {
        $this->val_max_slider = $val_max_slider;
        return $this;
    }
    /**
     * @return Collection|AttributObjet[]
     */
    public function getAttributObjets(): Collection
    {
        return $this->attributObjets;
    }
    public function addAttributObjet(AttributObjet $attributObjet): self
    {
        if (!$this->attributObjets->contains($attributObjet)) {
            $this->attributObjets[] = $attributObjet;
            $attributObjet->setSlider($this);
        }
        return $this;
    }
    public function removeAttributObjet(AttributObjet $attributObjet): self
    {
        if ($this->attributObjets->contains($attributObjet)) {
            $this->attributObjets->removeElement($attributObjet);
            // set the owning side to null (unless already changed)
            if ($attributObjet->getSlider() === $this) {
                $attributObjet->setSlider(null);
            }
        }
        return $this;
    }
}