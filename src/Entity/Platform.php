<?php

namespace App\Entity;

use App\Repository\PlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatformRepository::class)]
#[ORM\Table(name: 'platforms')]
class Platform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Tournament::class, mappedBy: 'platform')]
    private Collection $tournaments;

    public function __construct()
    {
        $this->tournaments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Tournament>
     */
    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    public function addTournament(Tournament $tournament): static
    {
        if (!$this->tournaments->contains($tournament)) {
            $this->tournaments->add($tournament);
            $tournament->setPlatform($this);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): static
    {
        if ($this->tournaments->removeElement($tournament)) {
            // set the owning side to null (unless already changed)
            if ($tournament->getPlatform() === $this) {
                $tournament->setPlatform(null);
            }
        }

        return $this;
    }
}
