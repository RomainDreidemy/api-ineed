<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"}
 * )
 * @ApiFilter(SearchFilter::class, properties={"postal_code": "exact"})
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArrondissementRepository")
 */
class Arrondissement
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
     * @ORM\Column(type="integer")
     */
    private $postal_code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hopital", mappedBy="Arrondissement")
     */
    private $hopitals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CentreDeSante", mappedBy="Arrondissement")
     */
    private $centreDeSantes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pharmacie", mappedBy="Arrondissement")
     */
    private $pharmacies;

    public function __construct()
    {
        $this->hopitals = new ArrayCollection();
        $this->centreDeSantes = new ArrayCollection();
        $this->pharmacies = new ArrayCollection();
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

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * @return Collection|Hopital[]
     */
    public function getHopitals(): Collection
    {
        return $this->hopitals;
    }

    public function addHopital(Hopital $hopital): self
    {
        if (!$this->hopitals->contains($hopital)) {
            $this->hopitals[] = $hopital;
            $hopital->setArrondissement($this);
        }

        return $this;
    }

    public function removeHopital(Hopital $hopital): self
    {
        if ($this->hopitals->contains($hopital)) {
            $this->hopitals->removeElement($hopital);
            // set the owning side to null (unless already changed)
            if ($hopital->getArrondissement() === $this) {
                $hopital->setArrondissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CentreDeSante[]
     */
    public function getCentreDeSantes(): Collection
    {
        return $this->centreDeSantes;
    }

    public function addCentreDeSante(CentreDeSante $centreDeSante): self
    {
        if (!$this->centreDeSantes->contains($centreDeSante)) {
            $this->centreDeSantes[] = $centreDeSante;
            $centreDeSante->setArrondissement($this);
        }

        return $this;
    }

    public function removeCentreDeSante(CentreDeSante $centreDeSante): self
    {
        if ($this->centreDeSantes->contains($centreDeSante)) {
            $this->centreDeSantes->removeElement($centreDeSante);
            // set the owning side to null (unless already changed)
            if ($centreDeSante->getArrondissement() === $this) {
                $centreDeSante->setArrondissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pharmacie[]
     */
    public function getPharmacies(): Collection
    {
        return $this->pharmacies;
    }

    public function addPharmacy(Pharmacie $pharmacy): self
    {
        if (!$this->pharmacies->contains($pharmacy)) {
            $this->pharmacies[] = $pharmacy;
            $pharmacy->setArrondissement($this);
        }

        return $this;
    }

    public function removePharmacy(Pharmacie $pharmacy): self
    {
        if ($this->pharmacies->contains($pharmacy)) {
            $this->pharmacies->removeElement($pharmacy);
            // set the owning side to null (unless already changed)
            if ($pharmacy->getArrondissement() === $this) {
                $pharmacy->setArrondissement(null);
            }
        }

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
