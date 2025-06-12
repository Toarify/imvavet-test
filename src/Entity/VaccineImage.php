<?php

namespace App\Entity;

use App\Repository\VaccineImageRepository;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich; // inserted

#[ORM\Entity(repositoryClass: VaccineImageRepository::class)]
#[Vich\Uploadable] // inserted
class VaccineImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vaccineImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vaccine $vaccine = null;

    // ----- insert ---------------------------
    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'vaccine', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVaccine(): ?Vaccine
    {
        return $this->vaccine;
    }

    public function setVaccine(?Vaccine $vaccine): static
    {
        $this->vaccine = $vaccine;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
        $this->updatedAt = new \DateTimeImmutable();
      }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
    // ------inserted --------
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
