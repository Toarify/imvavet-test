<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VaccineRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: VaccineRepository::class)]
class Vaccine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $game = null;

    /**
     * @var Collection<int, VaccineImage>
     */
    #[ORM\OneToMany(targetEntity: VaccineImage::class, mappedBy: 'vaccine', orphanRemoval: true, cascade:['persist'])]
    private Collection $vaccineImages;

    // vaccine details relation
    #[ORM\OneToOne(mappedBy: 'vaccine', targetEntity: VaccineDetails::class, cascade: ['persist', 'remove'])]
    private ?VaccineDetails $vaccineDetails = null;

    public function __construct()
    {
        $this->vaccineImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): static
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection<int, VaccineImage>
     */
    public function getVaccineImages(): Collection
    {
        return $this->vaccineImages;
    }

    public function addVaccineImage(VaccineImage $vaccineImage): static
    {
        if (!$this->vaccineImages->contains($vaccineImage)) {
            $this->vaccineImages->add($vaccineImage);
            $vaccineImage->setVaccine($this);
        }

        return $this;
    }

    public function removeVaccineImage(VaccineImage $vaccineImage): static
    {
        if ($this->vaccineImages->removeElement($vaccineImage)) {
            // set the owning side to null (unless already changed)
            if ($vaccineImage->getVaccine() === $this) {
                $vaccineImage->setVaccine(null);
            }
        }

        return $this;
    }

    //------------- inserted -------------------------------
    // public function __toString(): string
    // {
    //     $name = $this->name ?? 'N/A';
        
    //     // Décoder toutes les entités HTML (y compris &nbsp;, &reg;, etc.)
    //     $decoded = html_entity_decode($name, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
    //     // Supprimer les balises HTML et conserver uniquement le texte
    //     $cleaned = strip_tags($decoded);
        
    //     // Remplacer les espaces multiples par un seul espace
    //     return preg_replace('/\s+/', ' ', $cleaned);
    // }

    public function __toString(): string
    {
        return $this->getCleanName();
    }

    public function getCleanName(): string
    {
        $name = $this->name ?? 'N/A';
        
        // Décodage complet + suppression tags
        $cleaned = strip_tags(html_entity_decode($name, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        
        // Nettoyage avancé des espaces
        $cleaned = str_replace(["\xc2\xa0", "&nbsp;"], ' ', $cleaned); // Tous les types d'espaces insécables
        return trim(preg_replace('/\s+/', ' ', $cleaned)); // Espaces multiples -> simple
    }

    // ------ getSet vaccineDetails --------------------
    public function getVaccineDetails(): ?VaccineDetails
    {
        return $this->vaccineDetails;
    }

    public function setVaccineDetails(?VaccineDetails $details): self
    {
        // Assurez-vous que les deux entités sont synchronisées
        if ($details !== null) {
            $details->setVaccine($this);
        }
        $this->vaccineDetails = $details;
        return $this;
    }

}
