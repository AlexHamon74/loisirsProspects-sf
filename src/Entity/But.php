<?php

namespace App\Entity;

use App\Repository\ButRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Assistance>
     */
    #[ORM\OneToMany(targetEntity: Assistance::class, mappedBy: 'but')]
    private Collection $assistances;

    public function __construct()
    {
        $this->assistances = new ArrayCollection();
    }

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
            $assistance->setBut($this);
        }

        return $this;
    }

    public function removeAssistance(Assistance $assistance): static
    {
        if ($this->assistances->removeElement($assistance)) {
            // set the owning side to null (unless already changed)
            if ($assistance->getBut() === $this) {
                $assistance->setBut(null);
            }
        }

        return $this;
    }
}
