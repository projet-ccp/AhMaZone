<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $co_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $co_date = null;

    #[ORM\Column]
    private ?float $co_prix_total = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $co_cl_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoId(): ?int
    {
        return $this->co_id;
    }

    public function setCoId(int $co_id): static
    {
        $this->co_id = $co_id;

        return $this;
    }

    public function getCoDate(): ?\DateTimeInterface
    {
        return $this->co_date;
    }

    public function setCoDate(\DateTimeInterface $co_date): static
    {
        $this->co_date = $co_date;

        return $this;
    }

    public function getCoPrixTotal(): ?float
    {
        return $this->co_prix_total;
    }

    public function setCoPrixTotal(float $co_prix_total): static
    {
        $this->co_prix_total = $co_prix_total;

        return $this;
    }

    public function getCoClId(): ?Client
    {
        return $this->co_cl_id;
    }

    public function setCoClId(?Client $co_cl_id): static
    {
        $this->co_cl_id = $co_cl_id;

        return $this;
    }
}
