<?php

namespace App\Entity;

use App\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultRepository::class)]
#[ORM\Table(name: 'results')]
class Result
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $scoreTeamHome = null;

    #[ORM\Column]
    private ?int $scoreTeamAway = null;

    #[ORM\OneToOne(inversedBy: 'result', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $winner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScoreTeamHome(): ?int
    {
        return $this->scoreTeamHome;
    }

    public function setScoreTeamHome(int $scoreTeamHome): static
    {
        $this->scoreTeamHome = $scoreTeamHome;

        return $this;
    }

    public function getScoreTeamAway(): ?int
    {
        return $this->scoreTeamAway;
    }

    public function setScoreTeamAway(int $scoreTeamAway): static
    {
        $this->scoreTeamAway = $scoreTeamAway;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getWinner(): ?Team
    {
        return $this->winner;
    }

    public function setWinner(?Team $winner): static
    {
        $this->winner = $winner;

        return $this;
    }
}
