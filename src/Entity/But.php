<?php

namespace App\Entity;

use App\Repository\ButRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ButRepository::class)]
class But
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'buts')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'buts')]
    private ?Rencontre $rencontre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getRencontre(): ?Rencontre
    {
        return $this->rencontre;
    }

    public function setRencontre(?Rencontre $rencontre): static
    {
        $this->rencontre = $rencontre;

        return $this;
    }
}
