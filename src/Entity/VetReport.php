<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\VetReportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: VetReportRepository::class)]
class VetReport
{
    use HasIdTrait;
    use TimestampableEntity;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'vetReports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $state = null;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $food = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getContent().' ('.$this->getId().')';
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getFood(): ?string
    {
        return $this->food;
    }

    public function setFood(?string $food): static
    {
        $this->food = $food;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
