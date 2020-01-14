<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SpecialiteRepository")
 */
class Specialite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Horraire", mappedBy="Specialite")
     */
    private $horraires;

    public function __construct()
    {
        $this->horraires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Horraire[]
     */
    public function getHorraires(): Collection
    {
        return $this->horraires;
    }

    public function addHorraire(Horraire $horraire): self
    {
        if (!$this->horraires->contains($horraire)) {
            $this->horraires[] = $horraire;
            $horraire->setSpecialite($this);
        }

        return $this;
    }

    public function removeHorraire(Horraire $horraire): self
    {
        if ($this->horraires->contains($horraire)) {
            $this->horraires->removeElement($horraire);
            // set the owning side to null (unless already changed)
            if ($horraire->getSpecialite() === $this) {
                $horraire->setSpecialite(null);
            }
        }

        return $this;
    }
}
