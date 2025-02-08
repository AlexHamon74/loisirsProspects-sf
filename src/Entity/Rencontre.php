<?php

namespace App\Entity;

use App\Enum\Type_rencontre;
use App\Repository\RencontreRepository;
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

    #[ORM\Column(enumType: Type_rencontre::class)]
    private ?Type_rencontre $type_rencontre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $affiche = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

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

    public function getTypeRencontre(): ?Type_rencontre
    {
        return $this->type_rencontre;
    }

    public function setTypeRencontre(Type_rencontre $type_rencontre): static
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
}
