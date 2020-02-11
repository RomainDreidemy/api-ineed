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
 * @ORM\Entity(repositoryClass="App\Repository\SpecialiteRepository")
 * @ApiFilter(SearchFilter::class, properties={"CentreDeSante": "exact"})
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
     * @ORM\ManyToMany(targetEntity="App\Entity\CentreDeSante", inversedBy="specialites")
     */
    private $CentreDeSante;

    public function __construct()
    {
        $this->CentreDeSante = new ArrayCollection();
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
     * @return Collection|CentreDeSante[]
     */
    public function getCentreDeSante(): Collection
    {
        return $this->CentreDeSante;
    }

    public function addCentreDeSante(CentreDeSante $centreDeSante): self
    {
        if (!$this->CentreDeSante->contains($centreDeSante)) {
            $this->CentreDeSante[] = $centreDeSante;
        }

        return $this;
    }

    public function removeCentreDeSante(CentreDeSante $centreDeSante): self
    {
        if ($this->CentreDeSante->contains($centreDeSante)) {
            $this->CentreDeSante->removeElement($centreDeSante);
        }

        return $this;
    }
}
