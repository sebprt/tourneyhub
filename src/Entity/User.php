<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: UserPlatform::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $platforms;

    #[ORM\OneToMany(targetEntity: Registration::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $registrations;

    #[ORM\ManyToMany(targetEntity: VideoGame::class, mappedBy: 'users')]
    private Collection $videoGames;

    #[ORM\ManyToOne(inversedBy: 'members')]
    private ?Team $team = null;

    #[ORM\OneToMany(targetEntity: UserAward::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $userAwards;

    #[ORM\OneToMany(targetEntity: CashPriceContribution::class, mappedBy: 'contributor', orphanRemoval: true)]
    private Collection $cashPriceContributions;

    public function __construct()
    {
        $this->platforms = new ArrayCollection();
        $this->registrations = new ArrayCollection();
        $this->videoGames = new ArrayCollection();
        $this->userAwards = new ArrayCollection();
        $this->cashPriceContributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, UserPlatform>
     */
    public function getPlatforms(): Collection
    {
        return $this->platforms;
    }

    public function addPlatform(UserPlatform $userPlatform): static
    {
        if (!$this->platforms->contains($userPlatform)) {
            $this->platforms->add($userPlatform);
            $userPlatform->setUser($this);
        }

        return $this;
    }

    public function removePlatform(UserPlatform $userPlatform): static
    {
        if ($this->platforms->removeElement($userPlatform)) {
            // set the owning side to null (unless already changed)
            if ($userPlatform->getUser() === $this) {
                $userPlatform->setUser(null);
            }
        }

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
            $registration->setUser($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getUser() === $this) {
                $registration->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VideoGame>
     */
    public function getVideoGames(): Collection
    {
        return $this->videoGames;
    }

    public function addGame(VideoGame $game): static
    {
        if (!$this->videoGames->contains($game)) {
            $this->videoGames->add($game);
            $game->addUser($this);
        }

        return $this;
    }

    public function removeGame(VideoGame $game): static
    {
        if ($this->videoGames->removeElement($game)) {
            $game->removeUser($this);
        }

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

    /**
     * @return Collection<int, UserAward>
     */
    public function getUserAwards(): Collection
    {
        return $this->userAwards;
    }

    public function addUserAward(UserAward $userAward): static
    {
        if (!$this->userAwards->contains($userAward)) {
            $this->userAwards->add($userAward);
            $userAward->setUser($this);
        }

        return $this;
    }

    public function removeUserAward(UserAward $userAward): static
    {
        if ($this->userAwards->removeElement($userAward)) {
            // set the owning side to null (unless already changed)
            if ($userAward->getUser() === $this) {
                $userAward->setUser(null);
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
            $cashPriceContribution->setContributor($this);
        }

        return $this;
    }

    public function removeCashPriceContribution(CashPriceContribution $cashPriceContribution): static
    {
        if ($this->cashPriceContributions->removeElement($cashPriceContribution)) {
            // set the owning side to null (unless already changed)
            if ($cashPriceContribution->getContributor() === $this) {
                $cashPriceContribution->setContributor(null);
            }
        }

        return $this;
    }
}
