<?php

namespace App\Entity;

use App\Enum\TypeRencontre;
use App\Repository\RencontreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Saison $saison = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Equipe $equipe_domicile = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Equipe $equipe_exterieur = null;

    #[ORM\Column(nullable: true)]
    private ?int $score_equipe_domicile = null;

    #[ORM\Column(nullable: true)]
    private ?int $score_equipe_exterieur = null;

    #[ORM\Column(enumType: TypeRencontre::class)]
    private ?TypeRencontre $type_rencontre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $affiche = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $heure = null;

    /**
     * @var Collection<int, But>
     */
    #[ORM\OneToMany(targetEntity: But::class, mappedBy: 'rencontre')]
    private Collection $buts;

    /**
     * @var Collection<int, Participation>
     */
    #[ORM\OneToMany(targetEntity: Participation::class, mappedBy: 'rencontre')]
    private Collection $participations;

    public function __construct()
    {
        $this->buts = new ArrayCollection();
        $this->participations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): static
    {
        $this->saison = $saison;

        return $this;
    }

    public function getEquipeDomicile(): ?Equipe
    {
        return $this->equipe_domicile;
    }

    public function setEquipeDomicile(?Equipe $equipe_domicile): static
    {
        $this->equipe_domicile = $equipe_domicile;

        return $this;
    }

    public function getEquipeExterieur(): ?Equipe
    {
        return $this->equipe_exterieur;
    }

    public function setEquipeExterieur(?Equipe $equipe_exterieur): static
    {
        $this->equipe_exterieur = $equipe_exterieur;

        return $this;
    }

    public function getScoreEquipeDomicile(): ?int
    {
        return $this->score_equipe_domicile;
    }

    public function setScoreEquipeDomicile(?int $score_equipe_domicile): static
    {
        $this->score_equipe_domicile = $score_equipe_domicile;

        return $this;
    }

    public function getScoreEquipeExterieur(): ?int
    {
        return $this->score_equipe_exterieur;
    }

    public function setScoreEquipeExterieur(?int $score_equipe_exterieur): static
    {
        $this->score_equipe_exterieur = $score_equipe_exterieur;

        return $this;
    }

    public function getTypeRencontre(): ?TypeRencontre
    {
        return $this->type_rencontre;
    }

    public function setTypeRencontre(TypeRencontre $type_rencontre): static
    {
        $this->type_rencontre = $type_rencontre;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): static
    {
        $this->affiche = $affiche;

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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getHeure(): ?\DateTimeImmutable
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeImmutable $heure): static
    {
        $this->heure = $heure;

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
            $but->setRencontre($this);
        }

        return $this;
    }

    public function removeBut(But $but): static
    {
        if ($this->buts->removeElement($but)) {
            // set the owning side to null (unless already changed)
            if ($but->getRencontre() === $this) {
                $but->setRencontre(null);
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
            $participation->setRencontre($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): static
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getRencontre() === $this) {
                $participation->setRencontre(null);
            }
        }

        return $this;
    }
}
