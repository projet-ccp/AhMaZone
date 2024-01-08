<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cl_id = null;

    #[ORM\Column(length: 50)]
    private ?string $cl_nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $cl_adresse = null;

    #[ORM\Column]
    private ?int $cl_code_postal = null;

    #[ORM\Column(length: 100)]
    private ?string $cl_ville = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClId(): ?int
    {
        return $this->cl_id;
    }

    public function setClId(int $cl_id): static
    {
        $this->cl_id = $cl_id;

        return $this;
    }

    public function getClNom(): ?string
    {
        return $this->cl_nom;
    }

    public function setClNom(string $cl_nom): static
    {
        $this->cl_nom = $cl_nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getClAdresse(): ?string
    {
        return $this->cl_adresse;
    }

    public function setClAdresse(string $cl_adresse): static
    {
        $this->cl_adresse = $cl_adresse;

        return $this;
    }

    public function getClCodePostal(): ?int
    {
        return $this->cl_code_postal;
    }

    public function setClCodePostal(int $cl_code_postal): static
    {
        $this->cl_code_postal = $cl_code_postal;

        return $this;
    }

    public function getClVille(): ?string
    {
        return $this->cl_ville;
    }

    public function setClVille(string $cl_ville): static
    {
        $this->cl_ville = $cl_ville;

        return $this;
    }
}
