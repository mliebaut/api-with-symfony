<?php

namespace App\Entity;

use App\Repository\TypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypesRepository::class)
 */
class Types
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=EtatDesLieux::class, mappedBy="Types")
     */
    private $etatDesLieux;

    public function __construct()
    {
        $this->etatDesLieux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|EtatDesLieux[]
     */
    public function getEtatDesLieux(): Collection
    {
        return $this->etatDesLieux;
    }

    public function addEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if (!$this->etatDesLieux->contains($etatDesLieux)) {
            $this->etatDesLieux[] = $etatDesLieux;
            $etatDesLieux->setTypes($this);
        }

        return $this;
    }

    public function removeEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if ($this->etatDesLieux->removeElement($etatDesLieux)) {
            // set the owning side to null (unless already changed)
            if ($etatDesLieux->getTypes() === $this) {
                $etatDesLieux->setTypes(null);
            }
        }

        return $this;
    }
}
