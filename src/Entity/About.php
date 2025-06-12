<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $presentation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $leaderWord = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getLeaderWord(): ?string
    {
        return $this->leaderWord;
    }

    public function setLeaderWord(string $leaderWord): static
    {
        $this->leaderWord = $leaderWord;

        return $this;
    }
}
