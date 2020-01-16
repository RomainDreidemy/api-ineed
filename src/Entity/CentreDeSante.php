<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CentreDeSanteRepository")
 */
class CentreDeSante
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
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Arrondissement", inversedBy="centreDeSantes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Arrondissement;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Profil", inversedBy="centreDeSantes")
     */
    private $Profil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Horraire", mappedBy="CentreDeSante")
     */
    private $horraires;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Specialite", mappedBy="CentreDeSante")
     */
    private $specialites;

    public function __construct()
    {
        $this->Profil = new ArrayCollection();
        $this->horraires = new ArrayCollection();
        $this->specialites = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getArrondissement(): ?Arrondissement
    {
        return $this->Arrondissement;
    }

    public function setArrondissement(?Arrondissement $Arrondissement): self
    {
        $this->Arrondissement = $Arrondissement;

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
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->Profil->contains($profil)) {
            $this->Profil->removeElement($profil);
        }

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
            $horraire->setCentreDeSante($this);
        }

        return $this;
    }

    public function removeHorraire(Horraire $horraire): self
    {
        if ($this->horraires->contains($horraire)) {
            $this->horraires->removeElement($horraire);
            // set the owning side to null (unless already changed)
            if ($horraire->getCentreDeSante() === $this) {
                $horraire->setCentreDeSante(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Specialite[]
     */
    public function getSpecialites(): Collection
    {
        return $this->specialites;
    }

    public function addSpecialite(Specialite $specialite): self
    {
        if (!$this->specialites->contains($specialite)) {
            $this->specialites[] = $specialite;
            $specialite->addCentreDeSante($this);
        }

        return $this;
    }

    public function removeSpecialite(Specialite $specialite): self
    {
        if ($this->specialites->contains($specialite)) {
            $this->specialites->removeElement($specialite);
            $specialite->removeCentreDeSante($this);
        }

        return $this;
    }
}
