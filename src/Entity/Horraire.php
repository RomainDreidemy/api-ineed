<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"},
 *     attributes={"order"={"jour"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"Specialite": "exact", "CentreDeSante": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\HorraireRepository")
 */
class Horraire
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
    private $jour;

    /**
     * @ORM\Column(type="time")
     */
    private $time_start;

    /**
     * @ORM\Column(type="time")
     */
    private $time_end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CentreDeSante", inversedBy="horraires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CentreDeSante;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialite", inversedBy="horraires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Specialite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->time_start;
    }

    public function setTimeStart(\DateTimeInterface $time_start): self
    {
        $this->time_start = $time_start;

        return $this;
    }

    public function getTimeEnd(): ?\DateTimeInterface
    {
        return $this->time_end;
    }

    public function setTimeEnd(\DateTimeInterface $time_end): self
    {
        $this->time_end = $time_end;

        return $this;
    }

    public function getCentreDeSante(): ?CentreDeSante
    {
        return $this->CentreDeSante;
    }

    public function setCentreDeSante(?CentreDeSante $CentreDeSante): self
    {
        $this->CentreDeSante = $CentreDeSante;

        return $this;
    }

    public function getSpecialite(): ?Specialite
    {
        return $this->Specialite;
    }

    public function setSpecialite(?Specialite $Specialite): self
    {
        $this->Specialite = $Specialite;

        return $this;
    }
}
