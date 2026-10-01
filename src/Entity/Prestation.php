<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private ?string $Reference = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Prix = null;

    /**
     * @var Collection<int, Demande>
     */
    #[ORM\OneToMany(targetEntity: Demande::class, mappedBy: 'RefPresta')]
    private Collection $demandes;

    /**
     * @var Collection<int, Utiliser>
     */
    #[ORM\OneToMany(targetEntity: Utiliser::class, mappedBy: 'RefPresta')]
    private Collection $utilisers;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->utilisers = new ArrayCollection();
    }
    
    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function setReference(string $Reference): static
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): static
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->setRefPresta($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): static
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getRefPresta() === $this) {
                $demande->setRefPresta(null);
            }
        }

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
            $utiliser->setRefPresta($this);
        }

        return $this;
    }

    public function removeUtiliser(Utiliser $utiliser): static
    {
        if ($this->utilisers->removeElement($utiliser)) {
            // set the owning side to null (unless already changed)
            if ($utiliser->getRefPresta() === $this) {
                $utiliser->setRefPresta(null);
            }
        }

        return $this;
    }
}