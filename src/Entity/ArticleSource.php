<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleSourceRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ArticleSourceRepository::class)]
#[Vich\Uploadable]
class ArticleSource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articleSources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    #[Vich\UploadableField(mapping: 'article_source', fileNameProperty: 'pdfName', size: 'pdfSize')]
    

    private ?File $pdfFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $pdfName = null;

    #[ORM\Column(nullable: true)]
    private ?int $pdfSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;
        return $this;
    }

    public function setPdfFile(?File $pdfFile = null): void
    {
        // if ($pdfFile !== null) {
        //     $mimeType = $pdfFile->getMimeType();
        //     if (!in_array($mimeType, ['application/pdf', 'application/x-pdf'])) {
        //         throw new \InvalidArgumentException('Seuls les fichiers PDF sont acceptés');
        //     }
        // }
        
        $this->pdfFile = $pdfFile;

        if (null !== $pdfFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPdfFile(): ?File
    {
        return $this->pdfFile;
    }

    public function setPdfName(?string $pdfName): void
    {
        $this->pdfName = $pdfName;
    }

    public function getPdfName(): ?string
    {
        return $this->pdfName;
    }

    public function setPdfSize(?int $pdfSize): void
    {
        $this->pdfSize = $pdfSize;
    }

    public function getPdfSize(): ?int
    {
        return $this->pdfSize;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}