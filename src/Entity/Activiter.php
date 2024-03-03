<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Repository\ActiviterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActiviterRepository::class)]
class Activiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $name;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    #[Assert\LessThan(200)]
    private ?string $Description;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    #[Assert\LessThan(200)]
    private ?float $NPersonne;
    
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $Lieu;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    #[Assert\LessThan(200)]
    private ?float $Tarif;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $Image;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $Note;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    
    
public function getDescription(): ?string
{
    return $this->Description;
}

public function setDescription(string $Description): self
{
    $this->Description = $Description;

    return $this;
}

public function getNPersonne(): ?float
{
    return $this->NPersonne;
}

public function setNPersonne(float $NPersonne): static
{
    $this->NPersonne = $NPersonne;

    return $this;
}

    
    public function getLieu(): ?string
    {
        return $this->Lieu;
    }

    public function setLieu(string $Lieu): static
    {
        $this->Lieu = $Lieu;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->Tarif;
    }

    public function setTarif(float $Tarif): static
    {
        $this->Tarif = $Tarif;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(string $Note): static
    {
        $this->Note = $Note;

        return $this;
    }
}


