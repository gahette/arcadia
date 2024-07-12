<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

trait HasIdTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['animal:read', 'habitat:read', 'image:read', 'testimonial: read', 'service:read'])]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
