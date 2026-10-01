<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private ?string $Reference = null;

    #[ORM\Column(length: 30)]
    private ?string $Type = null;

    #[ORM\Column(length: 100)]
    private ?string $Marque = null;

    #[ORM\Column]
    private ?int $Stock = null;

    /**
     * @var Collection<int, Utiliser>
     */
    #[ORM\OneToMany(targetEntity: Utiliser::class, mappedBy: 'RefMat')]
    private Collection $utilisers;

    public function __construct()
    {
        $this->utilisers = new ArrayCollection();
    }

    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(string $Marque): static
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): static
    {
        $this->Stock = $Stock;

        return $this;
    }

    /**
     * @return Collection<int, Utiliser>
     */
    public function getUtilisers(): Collection
    {
        return $this->utilisers;
    }

    public function addUtiliser(Utiliser $utiliser): static
    {
        if (!$this->utilisers->contains($utiliser)) {
            $this->utilisers->add($utiliser);
            $utiliser->setRefMat($this);
        }

        return $this;
    }

    public function removeUtiliser(Utiliser $utiliser): static
    {
        if ($this->utilisers->removeElement($utiliser)) {
            // set the owning side to null (unless already changed)
            if ($utiliser->getRefMat() === $this) {
                $utiliser->setRefMat(null);
            }
        }

        return $this;
    }
}