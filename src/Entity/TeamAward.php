<?php

namespace App\Entity;

use App\Repository\TeamAwardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamAwardRepository::class)]
#[ORM\Table(name: 'team_awards')]
class TeamAward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $receivedAt = null;

    #[ORM\ManyToOne(inversedBy: 'teamAwards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Award $award = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReceivedAt(): ?\DateTimeImmutable
    {
        return $this->receivedAt;
    }

    public function setReceivedAt(\DateTimeImmutable $receivedAt): static
    {
        $this->receivedAt = $receivedAt;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

        return $this;
    }

    public function getAward(): ?Award
    {
        return $this->award;
    }

    public function setAward(?Award $award): static
    {
        $this->award = $award;

        return $this;
    }
}
