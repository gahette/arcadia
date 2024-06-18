<?php

namespace App\Entity;

use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;
    use TimestampableEntity;

    #[ORM\Column(length: 128)]
    private ?string $nikname = null;

    #[ORM\Column(length: 128)]
    private ?string $classification = null;

    #[ORM\Column(length: 128)]
    private ?string $area = null;

    #[ORM\Column(nullable: true)]
    private ?int $consultation_count = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitat $habitat = null;

    /**
     * @var Collection<int, VetReport>
     */
    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: VetReport::class, orphanRemoval: true)]
    private Collection $vetReports;

    /**
     * @var Collection<int, FoodConsumption>
     */
    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: FoodConsumption::class, orphanRemoval: true)]
    private Collection $foodConsumptions;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Image::class, orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->vetReports = new ArrayCollection();
        $this->foodConsumptions = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getNikname(): ?string
    {
        return $this->nikname;
    }

    public function setNikname(string $nikname): static
    {
        $this->nikname = $nikname;

        return $this;
    }

    public function getClassification(): ?string
    {
        return $this->classification;
    }

    public function setClassification(string $classification): static
    {
        $this->classification = $classification;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getConsultationCount(): ?int
    {
        return $this->consultation_count;
    }

    public function setConsultationCount(?int $consultation_count): static
    {
        $this->consultation_count = $consultation_count;

        return $this;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): static
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * @return Collection<int, VetReport>
     */
    public function getVetReports(): Collection
    {
        return $this->vetReports;
    }

    public function addVetReport(VetReport $vetReport): static
    {
        if (!$this->vetReports->contains($vetReport)) {
            $this->vetReports->add($vetReport);
            $vetReport->setAnimal($this);
        }

        return $this;
    }

    public function removeVetReport(VetReport $vetReport): static
    {
        if ($this->vetReports->removeElement($vetReport)) {
            // set the owning side to null (unless already changed)
            if ($vetReport->getAnimal() === $this) {
                $vetReport->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FoodConsumption>
     */
    public function getFoodConsumptions(): Collection
    {
        return $this->foodConsumptions;
    }

    public function addFoodConsumption(FoodConsumption $foodConsumption): static
    {
        if (!$this->foodConsumptions->contains($foodConsumption)) {
            $this->foodConsumptions->add($foodConsumption);
            $foodConsumption->setAnimal($this);
        }

        return $this;
    }

    public function removeFoodConsumption(FoodConsumption $foodConsumption): static
    {
        if ($this->foodConsumptions->removeElement($foodConsumption)) {
            // set the owning side to null (unless already changed)
            if ($foodConsumption->getAnimal() === $this) {
                $foodConsumption->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setAnimal($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAnimal() === $this) {
                $image->setAnimal(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName().' ('.$this->getId().')';
    }
}
