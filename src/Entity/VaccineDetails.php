<?php

namespace App\Entity;

use App\Repository\VaccineDetailsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VaccineDetailsRepository::class)]
class VaccineDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'vaccineDetails')]
    private ?Vaccine $vaccine = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $autorisation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $presentation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $farmaceticalForm = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $compositionDose = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $inicationContre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $secondEffect = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $manual = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $indication = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $precationUse = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $concervation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $waitTime = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $rappel = null;

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

    public function getAutorisation(): ?string
    {
        return $this->autorisation;
    }

    public function setAutorisation(string $autorisation): static
    {
        $this->autorisation = $autorisation;

        return $this;
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

    public function getFarmaceticalForm(): ?string
    {
        return $this->farmaceticalForm;
    }

    public function setFarmaceticalForm(?string $farmaceticalForm): static
    {
        $this->farmaceticalForm = $farmaceticalForm;

        return $this;
    }

    public function getCompositionDose(): ?string
    {
        return $this->compositionDose;
    }

    public function setCompositionDose(?string $compositionDose): static
    {
        $this->compositionDose = $compositionDose;

        return $this;
    }

    public function getInicationContre(): ?string
    {
        return $this->inicationContre;
    }

    public function setInicationContre(?string $inicationContre): static
    {
        $this->inicationContre = $inicationContre;

        return $this;
    }

    public function getSecondEffect(): ?string
    {
        return $this->secondEffect;
    }

    public function setSecondEffect(?string $secondEffect): static
    {
        $this->secondEffect = $secondEffect;

        return $this;
    }

    public function getManual(): ?string
    {
        return $this->manual;
    }

    public function setManual(?string $manual): static
    {
        $this->manual = $manual;

        return $this;
    }

    public function getIndication(): ?string
    {
        return $this->indication;
    }

    public function setIndication(?string $indication): static
    {
        $this->indication = $indication;

        return $this;
    }

    public function getPrecationUse(): ?string
    {
        return $this->precationUse;
    }

    public function setPrecationUse(?string $precationUse): static
    {
        $this->precationUse = $precationUse;

        return $this;
    }

    public function getConcervation(): ?string
    {
        return $this->concervation;
    }

    public function setConcervation(?string $concervation): static
    {
        $this->concervation = $concervation;

        return $this;
    }

    public function getWaitTime(): ?string
    {
        return $this->waitTime;
    }

    public function setWaitTime(?string $waitTime): static
    {
        $this->waitTime = $waitTime;

        return $this;
    }

    public function getRappel(): ?string
    {
        return $this->rappel;
    }

    public function setRappel(?string $rappel): static
    {
        $this->rappel = $rappel;

        return $this;
    }
}
