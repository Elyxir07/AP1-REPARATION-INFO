<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $IdUtil = null;

    /**
     * @var Collection<int, Prestation>
     */
    #[ORM\ManyToMany(targetEntity: Prestation::class, inversedBy: 'demandes')]
    #[ORM\JoinTable(name: 'demande_prestation')]
    #[ORM\JoinColumn(name: 'demande_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'prestation_reference', referencedColumnName: 'Reference')]
    private Collection $prestations;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $EtatDemande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Objet = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $Raison = null;

    #[ORM\Column(length: 300, nullable: true)]
    private ?string $Commentaire = null;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtil(): ?Utilisateur
    {
        return $this->IdUtil;
    }

    public function setIdUtil(?Utilisateur $IdUtil): static
    {
        $this->IdUtil = $IdUtil;

        return $this;
    }

    /**
     * @return Collection<int, Prestation>
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): static
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations->add($prestation);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): static
    {
        $this->prestations->removeElement($prestation);

        return $this;
    }

    public function getEtatDemande(): ?string
    {
        return $this->EtatDemande;
    }

    public function setEtatDemande(?string $EtatDemande): static
    {
        $this->EtatDemande = $EtatDemande;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->Objet;
    }

    public function setObjet(?string $Objet): static
    {
        $this->Objet = $Objet;

        return $this;
    }

    public function getRaison(): ?string
    {
        return $this->Raison;
    }

    public function setRaison(?string $Raison): static
    {
        $this->Raison = $Raison;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(?string $Commentaire): static
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->IdUtil;
    }
}