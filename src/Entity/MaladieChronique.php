<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MaladieChroniqueRepository")
 */
class MaladieChronique
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
     * @ORM\OneToMany(targetEntity="App\Entity\Profil", mappedBy="maladieChronique")
     */
    private $Profil;

    public function __construct()
    {
        $this->Profil = new ArrayCollection();
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
     * @return Collection|Profil[]
     */
    public function getProfil(): Collection
    {
        return $this->Profil;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->Profil->contains($profil)) {
            $this->Profil[] = $profil;
            $profil->setMaladieChronique($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->Profil->contains($profil)) {
            $this->Profil->removeElement($profil);
            // set the owning side to null (unless already changed)
            if ($profil->getMaladieChronique() === $this) {
                $profil->setMaladieChronique(null);
            }
        }

        return $this;
    }
}
