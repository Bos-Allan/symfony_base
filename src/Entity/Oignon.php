<?php

namespace App\Entity;

use App\Repository\OignonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OignonRepository::class)]
class Oignon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Burger>
     */
    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'oignon')]
    private Collection $burger;

    public function __construct()
    {
        $this->burger = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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
     * @return Collection<int, Burger>
     */
    public function getBurger(): Collection
    {
        return $this->burger;
    }

    public function addBurger(Burger $burger): static
    {
        if (!$this->burger->contains($burger)) {
            $this->burger->add($burger);
            $burger->addOignon($this);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): static
    {
        if ($this->burger->removeElement($burger)) {
            $burger->removeOignon($this);
        }

        return $this;
    }
}
