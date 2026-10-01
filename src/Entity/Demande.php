<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'demandes')]
    #[ORM\JoinColumn(referencedColumnName: 'id', nullable: false)]
    private ?Utilisateur $IdUtil = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'demandes')]
    #[ORM\JoinColumn(referencedColumnName: 'Reference', nullable: false)]
    private ?Prestation $RefPresta = null;

    #[ORM\Column(length: 100)]
    private ?string $EtatDemande = null;

    #[ORM\Column(length: 255)]
    private ?string $Objet = null;

    #[ORM\Column(length: 100)]
    private ?string $Raison = null;

    #[ORM\Column(length: 300)]
    private ?string $Commentaire = null;

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

    public function getRefPresta(): ?Prestation
    {
        return $this->RefPresta;
    }

    public function setRefPresta(?Prestation $RefPresta): static
    {
        $this->RefPresta = $RefPresta;

        return $this;
    }

    public function getEtatDemande(): ?string
    {
        return $this->EtatDemande;
    }

    public function setEtatDemande(string $EtatDemande): static
    {
        $this->EtatDemande = $EtatDemande;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->Objet;
    }

    public function setObjet(string $Objet): static
    {
        $this->Objet = $Objet;

        return $this;
    }

    public function getRaison(): ?string
    {
        return $this->Raison;
    }

    public function setRaison(string $Raison): static
    {
        $this->Raison = $Raison;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(string $Commentaire): static
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }
}
