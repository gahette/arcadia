<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\TestimonialRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: TestimonialRepository::class)]
class Testimonial
{
    use HasIdTrait;
    use HasTimestampTrait;

    #[ORM\Column(length: 128)]
    #[Groups(['testimonial: read'])]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    #[Groups(['testimonial: read'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Groups(['testimonial: read'])]
    private ?bool $is_visible = null;

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->is_visible;
    }

    public function setIsVisible(bool $is_visible): self
    {
        $this->is_visible = $is_visible;

        return $this;
    }
}
