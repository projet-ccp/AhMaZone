<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pr_id = null;

    #[ORM\Column(length: 50)]
    private ?string $pr_label = null;

    #[ORM\Column]
    private ?float $pr_prix_unit = null;

    #[ORM\Column]
    private ?int $pr_quantite_stock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrId(): ?int
    {
        return $this->pr_id;
    }

    public function setPrId(int $pr_id): static
    {
        $this->pr_id = $pr_id;

        return $this;
    }

    public function getPrLabel(): ?string
    {
        return $this->pr_label;
    }

    public function setPrLabel(string $pr_label): static
    {
        $this->pr_label = $pr_label;

        return $this;
    }

    public function getPrPrixUnit(): ?float
    {
        return $this->pr_prix_unit;
    }

    public function setPrPrixUnit(float $pr_prix_unit): static
    {
        $this->pr_prix_unit = $pr_prix_unit;

        return $this;
    }

    public function getPrQuantiteStock(): ?int
    {
        return $this->pr_quantite_stock;
    }

    public function setPrQuantiteStock(int $pr_quantite_stock): static
    {
        $this->pr_quantite_stock = $pr_quantite_stock;

        return $this;
    }
}
