<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\Table(name: 'games')]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tournament $tournament = null;

    #[ORM\OneToOne(mappedBy: 'game', cascade: ['persist', 'remove'])]
    private ?Result $result = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamHome = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamAway = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $livestreamUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): static
    {
        $this->tournament = $tournament;

        return $this;
    }

    public function getResult(): ?Result
    {
        return $this->result;
    }

    public function setResult(Result $result): static
    {
        // set the owning side of the relation if necessary
        if ($result->getGame() !== $this) {
            $result->setGame($this);
        }

        $this->result = $result;

        return $this;
    }

    public function getTeamHome(): ?Team
    {
        return $this->teamHome;
    }

    public function setTeamHome(?Team $teamHome): static
    {
        $this->teamHome = $teamHome;

        return $this;
    }

    public function getTeamAway(): ?Team
    {
        return $this->teamAway;
    }

    public function setTeamAway(?Team $teamAway): static
    {
        $this->teamAway = $teamAway;

        return $this;
    }

    public function getLivestreamUrl(): ?string
    {
        return $this->livestreamUrl;
    }

    public function setLivestreamUrl(?string $livestreamUrl): static
    {
        $this->livestreamUrl = $livestreamUrl;

        return $this;
    }
}
