<?php
namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    /**
     * @var Collection<int, ArticleImage>
     */
    #[ORM\OneToMany(targetEntity: ArticleImage::class, mappedBy: 'article', orphanRemoval: true, cascade:['persist'])]
    private Collection $articleImages;

    #[ORM\OneToOne(mappedBy: 'article', targetEntity: ArticleDetails::class, cascade: ['persist', 'remove'])]
    private ?ArticleDetails $details = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: Types::TEXT,nullable: true)]
    private ?string $Abstract = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $firstAthor = null;

    #[ORM\Column(type: Types::TEXT,nullable: true)]
    private ?string $otherAuthor = null;

    // Dans la classe Article, ajoutez cette propriété:

    /**
     * @var Collection<int, ArticleSource>
     */
    #[ORM\OneToMany(targetEntity: ArticleSource::class, mappedBy: 'article', orphanRemoval: true, cascade: ['persist'])]
    private Collection $articleSources;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Url = null;

    // Dans le constructeur, ajoutez:

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $createdBy = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $updatedBy = null; 


    public function __construct()
    {
        $this->articleImages = new ArrayCollection();
        $this->articleSources = new ArrayCollection();
        $this->createdAt = new \DateTime();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Collection<int, ArticleImage>
     */
    public function getArticleImages(): Collection
    {
        return $this->articleImages;
    }

    public function addArticleImage(ArticleImage $articleImage): static
    {
        if (!$this->articleImages->contains($articleImage)) {
            $this->articleImages->add($articleImage);
            $articleImage->setArticle($this);
        }

        return $this;
    }

    public function removeArticleImage(ArticleImage $articleImage): static
    {
        if ($this->articleImages->removeElement($articleImage)) {
            if ($articleImage->getArticle() === $this) {
                $articleImage->setArticle(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getCleanName();
    }

    public function getCleanName(): string
    {
        // $name = $this->name ?? 'N/A';
        // $cleaned = strip_tags(html_entity_decode($name, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        // $cleaned = str_replace(["\xc2\xa0", "&nbsp;"], ' ', $cleaned);
        // return trim(preg_replace('/\s+/', ' ', $cleaned));
        return $this->cleanText($this->name);
    }


    private function cleanText(?string $text): string
{
    if (null === $text) {
        return 'N/A';
    }
    
    $cleaned = strip_tags(html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $cleaned = str_replace(["\xc2\xa0", "&nbsp;"], ' ', $cleaned);
    return trim(preg_replace('/\s+/', ' ', $cleaned));
}


    public function getDetails(): ?ArticleDetails
    {
        return $this->details;
    }

    public function setDetails(?ArticleDetails $details): self
    {
        if ($details !== null) {
            $details->setArticle($this);
        }
        $this->details = $details;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->createdAt  = (new \DateTime())->modify('+3 hours');
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt  = (new \DateTime())->modify('+3 hours');
    }

    public function getAbstract(): ?string
    {
        return $this->Abstract;
    }

    public function setAbstract(string $Abstract): static
    {
        $this->Abstract = $Abstract;

        return $this;
    }

    public function getFirstAthor(): ?string
    {
        return $this->firstAthor;
    }

    public function setFirstAthor(string $firstAthor): static
    {
        $this->firstAthor = $firstAthor;

        return $this;
    }

    public function getOtherAuthor(): ?string
    {
        return $this->otherAuthor;
    }

    public function setOtherAuthor(string $otherAuthor): static
    {
        $this->otherAuthor = $otherAuthor;

        return $this;
    }

    public function getCleanAbstract(): string
    {
        return $this->cleanText($this->Abstract);
    }

    public function getCleanFirstAuthor(): string
    {
        return $this->cleanText($this->firstAthor);
    }

    public function getCleanOtherAuthor(): string
    {
        return $this->cleanText($this->otherAuthor);
    }





// Ajoutez ces méthodes:
/**
 * @return Collection<int, ArticleSource>
 */
public function getArticleSources(): Collection
{
    return $this->articleSources;
}

public function addArticleSource(ArticleSource $articleSource): static
{
    if (!$this->articleSources->contains($articleSource)) {
        $this->articleSources->add($articleSource);
        $articleSource->setArticle($this);
    }

    return $this;
}

public function removeArticleSource(ArticleSource $articleSource): static
{
    if ($this->articleSources->removeElement($articleSource)) {
        if ($articleSource->getArticle() === $this) {
            $articleSource->setArticle(null);
        }
    }

    return $this;
}

public function getUrl(): ?string
{
    return $this->Url;
}

public function setUrl(?string $Url): static
{
    $this->Url = $Url;

    return $this;
}



public function getCreatedBy(): ?User
{
    return $this->createdBy;
}

public function setCreatedBy(?User $createdBy): static
{
    $this->createdBy = $createdBy;
    return $this;
}

public function getUpdatedBy(): ?User
{
    return $this->updatedBy;
}

public function setUpdatedBy(?User $updatedBy): static
{
    $this->updatedBy = $updatedBy;
    return $this;
}


}