<?php

namespace App\Entity;

use App\Repository\UtiliserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtiliserRepository::class)]
class Utiliser
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'utilisers')]
    #[ORM\JoinColumn(referencedColumnName: 'Reference', nullable: false)]
    private ?Prestation $RefPresta = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'utilisers')]
    #[ORM\JoinColumn(referencedColumnName: 'Reference', nullable: false)]
    private ?Materiel $RefMat = null;

    #[ORM\Column]
    private ?int $Quantite = null;

    public function getRefPresta(): ?Prestation
    {
        return $this->RefPresta;
    }

    public function setRefPresta(?Prestation $RefPresta): static
    {
        $this->RefPresta = $RefPresta;

        return $this;
    }

    public function getRefMat(): ?Materiel
    {
        return $this->RefMat;
    }

    public function setRefMat(?Materiel $RefMat): static
    {
        $this->RefMat = $RefMat;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): static
    {
        $this->Quantite = $Quantite;

        return $this;
    }
}