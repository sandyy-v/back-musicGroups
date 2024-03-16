<?php

namespace App\Entity;

use App\Repository\MusicGroupRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicGroupRepository::class)]
class MusicGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $groupName = null;
    
    #[ORM\Column(length: 255)]
    private ?string $origin = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column]
    private ?int $startYear = null;

    #[ORM\Column(nullable: true)]
    private ?int $endYear = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $founder = null;

    #[ORM\Column(nullable: true)]
    private ?int $members = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $musicStyle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $presentation = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    public function setGroupName(string $groupName): static
    {
        $this->groupName = $groupName;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getStartYear(): ?int
    {
        return $this->startYear;
    }

    public function setStartYear(int $startYear): static
    {
        $this->startYear = $startYear;

        return $this;
    }

    public function getEndYear(): ?int
    {
        return $this->endYear;
    }

    public function setEndYear(?int $endYear): static
    {
        $this->endYear = $endYear;

        return $this;
    }

    public function getFounder(): ?string
    {
        return $this->founder;
    }

    public function setFounder(?string $founder): static
    {
        $this->founder = $founder;

        return $this;
    }

    public function getMembers(): ?int
    {
        return $this->members;
    }

    public function setMembers(?int $members): static
    {
        $this->members = $members;

        return $this;
    }

    public function getMusicStyle(): ?string
    {
        return $this->musicStyle;
    }

    public function setMusicStyle(?string $musicStyle): static
    {
        $this->musicStyle = $musicStyle;

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
}
