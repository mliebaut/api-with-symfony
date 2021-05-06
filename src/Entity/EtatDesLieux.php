<?php

namespace App\Entity;

use App\Repository\EtatDesLieuxRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EtatDesLieuxRepository::class)
 */
class EtatDesLieux
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"show_etatdeslieux", "list_etatdeslieux"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"show_etatdeslieux", "list_etatdeslieux"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"show_etatdeslieux", "list_etatdeslieux"})
     */
    private $nbPieces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"show_etatdeslieux", "list_etatdeslieux"})
     */
    private $surface;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"show_etatdeslieux", "list_etatdeslieux"})
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Types::class, inversedBy="etatDesLieux")
     * @Groups({"show_etatdeslieux", "list_etatdeslieux"})
     */
    private $Types;


    /**
     * @ORM\ManyToOne(targetEntity=Villes::class, inversedBy="etatDesLieux")
     * @Groups({"show_etatdeslieux", "list_etatdeslieux"})
     */
    private $Villes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbPieces(): ?string
    {
        return $this->nbPieces;
    }

    public function setNbPieces(?string $nbPieces): self
    {
        $this->nbPieces = $nbPieces;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(?string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTypes(): ?Types
    {
        return $this->Types;
    }

    public function setTypes(?Types $Types): self
    {
        $this->Types = $Types;

        return $this;
    }

    public function getVilles(): ?Villes
    {
        return $this->Villes;
    }

    public function setVilles(?Villes $Villes): self
    {
        $this->Villes = $Villes;

        return $this;
    }

}
