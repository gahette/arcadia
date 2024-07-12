<?php

namespace App\Entity\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

trait HasDescriptionTrait
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['animal:read', 'image:read', 'service:read', 'habitat:read'])]
    private ?string $description = null;

    private function stripHtml(string $html): string
    {
        return strip_tags($html, '<br><p><a><strong><em><ul><li><ol><b><i><u>');
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = null !== $description ? $this->stripHtml($description) : null;

        return $this;
    }
}
