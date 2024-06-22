<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\FoodConsumptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: FoodConsumptionRepository::class)]
class FoodConsumption
{
    use HasIdTrait;
    use TimestampableEntity;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $food = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'foodConsumptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

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
        return $this->getFood();
    }
}
