<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"}
 * )
 * @ApiFilter(SearchFilter::class, properties={"Profil": "exact", "Arrondissement": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\PharmacieRepository")
 */
class Pharmacie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telecopie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Profil", inversedBy="pharmacies")
     */
    private $Profil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Arrondissement", inversedBy="pharmacies")
     */
    private $Arrondissement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $open_night;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $open_sunday;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $open_all;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place_id;

    /**
     * @ORM\Column(type="json_array")
     */
    private $horraires = [];

    public function __construct()
    {
        $this->Profil = new ArrayCollection();
        $this->pharmacieHorraires = new ArrayCollection();
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

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTelecopie(): ?int
    {
        return $this->telecopie;
    }

    public function setTelecopie(int $telecopie): self
    {
        $this->telecopie = $telecopie;

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

    public function getArrondissement(): ?Arrondissement
    {
        return $this->Arrondissement;
    }

    public function setArrondissement(?Arrondissement $Arrondissement): self
    {
        $this->Arrondissement = $Arrondissement;

        return $this;
    }

    public function getOpenNight(): ?bool
    {
        return $this->open_night;
    }

    public function setOpenNight(bool $open_night): self
    {
        $this->open_night = $open_night;

        return $this;
    }

    public function getOpenSunday(): ?bool
    {
        return $this->open_sunday;
    }

    public function setOpenSunday(bool $open_sunday): self
    {
        $this->open_sunday = $open_sunday;

        return $this;
    }

    public function getOpenAll(): ?bool
    {
        return $this->open_all;
    }

    public function setOpenAll(bool $open_all): self
    {
        $this->open_all = $open_all;

        return $this;
    }

    public function getPlaceId(): ?string
    {
        return $this->place_id;
    }

    public function setPlaceId(string $place_id): self
    {
        $this->place_id = $place_id;

        return $this;
    }

    public function getHorraires(): ?array
    {
        return $this->horraires;
    }

    public function setHorraires(array $horraires): self
    {
        $this->horraires = $horraires;

        return $this;
    }
}
