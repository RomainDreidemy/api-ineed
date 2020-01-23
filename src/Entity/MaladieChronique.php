<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"}
 * )
 * @ApiFilter(SearchFilter::class, properties={"Profil": "exact"})
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Profil", inversedBy="maladieChroniques")
     */
    private $Profil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieMaladieChronique", inversedBy="MaladieChronique")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieMaladieChronique;

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

    public function getProfil(): ?Profil
    {
        return $this->Profil;
    }

    public function setProfil(?Profil $Profil): self
    {
        $this->Profil = $Profil;

        return $this;
    }

    public function getCategorieMaladieChronique(): ?CategorieMaladieChronique
    {
        return $this->categorieMaladieChronique;
    }

    public function setCategorieMaladieChronique(?CategorieMaladieChronique $categorieMaladieChronique): self
    {
        $this->categorieMaladieChronique = $categorieMaladieChronique;

        return $this;
    }
}
