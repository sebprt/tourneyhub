<?php

namespace App\Entity;

use App\Repository\CashPriceContributionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CashPriceContributionRepository::class)]
#[ORM\Table(name: 'cash_price_contributions')]
class CashPriceContribution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $amount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $contributedAt = null;

    #[ORM\ManyToOne(inversedBy: 'cashPriceContributions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $contributor = null;

    #[ORM\ManyToOne(inversedBy: 'cashPriceContributions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tournament $tournament = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getContributedAt(): ?\DateTimeImmutable
    {
        return $this->contributedAt;
    }

    public function setContributedAt(\DateTimeImmutable $contributedAt): static
    {
        $this->contributedAt = $contributedAt;

        return $this;
    }

    public function getContributor(): ?User
    {
        return $this->contributor;
    }

    public function setContributor(?User $contributor): static
    {
        $this->contributor = $contributor;

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
}
