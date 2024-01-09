<?php

namespace App\Entity;

use App\Repository\CommProdRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommProdRepository::class)]
class CommProd
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $cp_co_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $cp_pr_id = null;

    #[ORM\Column]
    private ?int $cp_quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCpCoId(): ?Commande
    {
        return $this->cp_co_id;
    }

    public function setCpCoId(?Commande $cp_co_id): static
    {
        $this->cp_co_id = $cp_co_id;

        return $this;
    }

    public function getCpPrId(): ?Produit
    {
        return $this->cp_pr_id;
    }

    public function setCpPrId(?Produit $cp_pr_id): static
    {
        $this->cp_pr_id = $cp_pr_id;

        return $this;
    }

    public function getCpQuantite(): ?int
    {
        return $this->cp_quantite;
    }

    public function setCpQuantite(int $cp_quantite): static
    {
        $this->cp_quantite = $cp_quantite;

        return $this;
    }
}
