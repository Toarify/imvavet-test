<?php

// src/Entity/ArticleDetails.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleDetailsRepository;

#[ORM\Entity(repositoryClass: ArticleDetailsRepository::class)]
class ArticleDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $authors = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $publicationDate = null;
    
    #[ORM\OneToOne(inversedBy: 'details', targetEntity: Article::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Article $article = null;

    // Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthors(): ?string
    {
        return $this->authors;
    }

    public function setAuthors(string $authors): self
    {
        $this->authors = $authors;
        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;
        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(Article $article): self
    {
        $this->article = $article;
        return $this;
    }
}

