<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgrammationRepository")
 * 
 * @Serializer\ExclusionPolicy("ALL")
 */
class Programmation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Serializer\Expose
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose
     */
    private $heure;
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose
     */
    private $jour;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ObjetPiece", inversedBy="programmations")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Serializer\Expose
     */
    private $objet_piece;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     * 
     * @Serializer\Expose
     */
    private $val_etat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Serializer\Expose
     */
    private $val_slider;
    
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
    public function getJour(): ?string
    {
        return $this->jour;
    }
    public function setJour(string $jour): self
    {
        $this->jour = $jour;
        return $this;
    }
    public function getObjetPiece(): ?ObjetPiece
    {
        return $this->objet_piece;
    }
    public function setObjetPiece(?ObjetPiece $objet_piece): self
    {
        $this->objet_piece = $objet_piece;
        return $this;
    }
}