<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\OpeningHourRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHourRepository::class)]
class OpeningHour
{
    use HasIdTrait;

    #[ORM\Column(length: 128)]
    private ?string $day = null;

    #[ORM\Column(length: 128)]
    private ?string $opening_time = null;

    #[ORM\Column(length: 128)]
    private ?string $closing_time = null;

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningTime(): ?string
    {
        return $this->opening_time;
    }

    public function setOpeningTime(string $opening_time): static
    {
        $this->opening_time = $opening_time;

        return $this;
    }

    public function getClosingTime(): ?string
    {
        return $this->closing_time;
    }

    public function setClosingTime(string $closing_time): static
    {
        $this->closing_time = $closing_time;

        return $this;
    }
}
