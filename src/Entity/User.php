<?php

namespace App\Entity;

use App\Enum\Position;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Cet email existe déjà')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message:'Ce champ est obligatoire')]
    #[Assert\Email(message:"L'email doit être valide")]
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
    #[Assert\NotBlank(message:'Ce champ est obligatoire')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Ce champ est obligatoire')]
    private ?string $firstname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(nullable: true)]
    private ?int $height = null;

    #[ORM\Column(nullable: true)]
    private ?int $weight = null;

    #[ORM\Column(nullable: true)]
    private ?int $jersey_number = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $profil_picture = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(nullable: true, enumType: Position::class)]
    private ?Position $position = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Equipe $equipe = null;

    /**
     * @var Collection<int, But>
     */
    #[ORM\OneToMany(targetEntity: But::class, mappedBy: 'user')]
    private Collection $buts;

    /**
     * @var Collection<int, Participation>
     */
    #[ORM\OneToMany(targetEntity: Participation::class, mappedBy: 'user')]
    private Collection $participations;

    /**
     * @var Collection<int, Assistance>
     */
    #[ORM\OneToMany(targetEntity: Assistance::class, mappedBy: 'user')]
    private Collection $assistances;

    public function __construct()
    {
        $this->buts = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->assistances = new ArrayCollection();
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
    public function getPassword(): ?string
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getJerseyNumber(): ?int
    {
        return $this->jersey_number;
    }

    public function setJerseyNumber(?int $jersey_number): static
    {
        $this->jersey_number = $jersey_number;

        return $this;
    }

    public function getProfilPicture(): ?string
    {
        return $this->profil_picture;
    }

    public function setProfilPicture(?string $profil_picture): static
    {
        $this->profil_picture = $profil_picture;

        // if (null !== $profil_picture) {
        //     // It is required that at least one field changes if you are using doctrine
        //     // otherwise the event listeners won't be called and the file is lost
        //     $this->updated_at = new \DateTimeImmutable();
        // }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): static
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * @return Collection<int, But>
     */
    public function getButs(): Collection
    {
        return $this->buts;
    }

    public function addBut(But $but): static
    {
        if (!$this->buts->contains($but)) {
            $this->buts->add($but);
            $but->setUser($this);
        }

        return $this;
    }

    public function removeBut(But $but): static
    {
        if ($this->buts->removeElement($but)) {
            // set the owning side to null (unless already changed)
            if ($but->getUser() === $this) {
                $but->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Participation>
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): static
    {
        if (!$this->participations->contains($participation)) {
            $this->participations->add($participation);
            $participation->setUser($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): static
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getUser() === $this) {
                $participation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Assistance>
     */
    public function getAssistances(): Collection
    {
        return $this->assistances;
    }

    public function addAssistance(Assistance $assistance): static
    {
        if (!$this->assistances->contains($assistance)) {
            $this->assistances->add($assistance);
            $assistance->setUser($this);
        }

        return $this;
    }

    public function removeAssistance(Assistance $assistance): static
    {
        if ($this->assistances->removeElement($assistance)) {
            // set the owning side to null (unless already changed)
            if ($assistance->getUser() === $this) {
                $assistance->setUser(null);
            }
        }

        return $this;
    }
}
