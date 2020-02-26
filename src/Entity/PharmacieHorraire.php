<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PharmacieHorraireRepository")
 */
class PharmacieHorraire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $timeStart;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $timeEnd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pharmacie", inversedBy="pharmacieHorraires")
     */
    private $Pharmacie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->timeStart;
    }

    public function setTimeStart(?\DateTimeInterface $timeStart): self
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    public function getTimeEnd(): ?\DateTimeInterface
    {
        return $this->timeEnd;
    }

    public function setTimeEnd(?\DateTimeInterface $timeEnd): self
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(?string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getPharmacie(): ?Pharmacie
    {
        return $this->Pharmacie;
    }

    public function setPharmacie(?Pharmacie $Pharmacie): self
    {
        $this->Pharmacie = $Pharmacie;

        return $this;
    }
}
