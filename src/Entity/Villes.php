<?php

namespace App\Entity;

use App\Repository\VillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 */
class Villes
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
    private $nomVille;

    /**
     * @ORM\OneToMany(targetEntity=EtatDesLieux::class, mappedBy="villes")
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

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(?string $nomVille): self
    {
        $this->nomVille = $nomVille;

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
            $etatDesLieux->setVilles($this);
        }

        return $this;
    }

    public function removeEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if ($this->etatDesLieux->removeElement($etatDesLieux)) {
            // set the owning side to null (unless already changed)
            if ($etatDesLieux->getVilles() === $this) {
                $etatDesLieux->setVilles(null);
            }
        }

        return $this;
    }
}
