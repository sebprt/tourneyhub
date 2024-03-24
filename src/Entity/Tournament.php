<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
#[ORM\Table(name: 'tournaments')]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $format = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $rules = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startAt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(targetEntity: Registration::class, mappedBy: 'tournament', orphanRemoval: true)]
    private Collection $registrations;

    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'tournament', orphanRemoval: true)]
    private Collection $games;

    #[ORM\OneToMany(targetEntity: Leaderboard::class, mappedBy: 'tournament', orphanRemoval: true)]
    private Collection $leaderboards;

    #[ORM\OneToMany(targetEntity: CashPriceContribution::class, mappedBy: 'tournament', orphanRemoval: true)]
    private Collection $cashPriceContributions;

    #[ORM\OneToOne(mappedBy: 'tournament', cascade: ['persist', 'remove'])]
    private ?CashPrice $cashPrice = null;

    #[ORM\ManyToOne(inversedBy: 'tournaments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VideoGame $videoGame = null;

    #[ORM\ManyToOne(inversedBy: 'tournament')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Platform $platform = null;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->leaderboards = new ArrayCollection();
        $this->cashPriceContributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getRules(): ?string
    {
        return $this->rules;
    }

    public function setRules(string $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): static
    {
        $this->startAt = $startAt;

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

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): static
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations->add($registration);
            $registration->setTournament($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getTournament() === $this) {
                $registration->setTournament(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setTournament($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getTournament() === $this) {
                $game->setTournament(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Leaderboard>
     */
    public function getLeaderboards(): Collection
    {
        return $this->leaderboards;
    }

    public function addLeaderboard(Leaderboard $leaderboard): static
    {
        if (!$this->leaderboards->contains($leaderboard)) {
            $this->leaderboards->add($leaderboard);
            $leaderboard->setTournament($this);
        }

        return $this;
    }

    public function removeLeaderboard(Leaderboard $leaderboard): static
    {
        if ($this->leaderboards->removeElement($leaderboard)) {
            // set the owning side to null (unless already changed)
            if ($leaderboard->getTournament() === $this) {
                $leaderboard->setTournament(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CashPriceContribution>
     */
    public function getCashPriceContributions(): Collection
    {
        return $this->cashPriceContributions;
    }

    public function addCashPriceContribution(CashPriceContribution $cashPriceContribution): static
    {
        if (!$this->cashPriceContributions->contains($cashPriceContribution)) {
            $this->cashPriceContributions->add($cashPriceContribution);
            $cashPriceContribution->setTournament($this);
        }

        return $this;
    }

    public function removeCashPriceContribution(CashPriceContribution $cashPriceContribution): static
    {
        if ($this->cashPriceContributions->removeElement($cashPriceContribution)) {
            // set the owning side to null (unless already changed)
            if ($cashPriceContribution->getTournament() === $this) {
                $cashPriceContribution->setTournament(null);
            }
        }

        return $this;
    }

    public function getCashPrice(): ?CashPrice
    {
        return $this->cashPrice;
    }

    public function setCashPrice(CashPrice $cashPrice): static
    {
        // set the owning side of the relation if necessary
        if ($cashPrice->getTournament() !== $this) {
            $cashPrice->setTournament($this);
        }

        $this->cashPrice = $cashPrice;

        return $this;
    }

    public function getVideoGame(): ?VideoGame
    {
        return $this->videoGame;
    }

    public function setVideoGame(?VideoGame $videoGame): static
    {
        $this->videoGame = $videoGame;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): static
    {
        $this->platform = $platform;

        return $this;
    }
}
