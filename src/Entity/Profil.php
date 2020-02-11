<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"User": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ProfilRepository")
 */
class Profil
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="App\Service\IdGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $blood_type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $information;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="profils")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medicament", mappedBy="Profil")
     */
    private $medicaments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pharmacie", mappedBy="Profil")
     */
    private $pharmacies;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CentreDeSante", mappedBy="Profil")
     */
    private $centreDeSantes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MaladieChronique", mappedBy="Profil")
     */
    private $maladieChroniques;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Hopital", mappedBy="Profil")
     */
    private $hopitals;

    public function __construct()
    {
        $this->medicaments = new ArrayCollection();
        $this->pharmacies = new ArrayCollection();
        $this->centreDeSantes = new ArrayCollection();
        $this->maladieChroniques = new ArrayCollection();
        $this->hopitals = new ArrayCollection();
    }

    public function getId(): ?string
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getBloodType(): ?string
    {
        return $this->blood_type;
    }

    public function setBloodType(string $blood_type): self
    {
        $this->blood_type = $blood_type;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|Medicament[]
     */
    public function getMedicaments(): Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments[] = $medicament;
            $medicament->setProfil($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicaments->contains($medicament)) {
            $this->medicaments->removeElement($medicament);
            // set the owning side to null (unless already changed)
            if ($medicament->getProfil() === $this) {
                $medicament->setProfil(null);
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
            $pharmacy->addProfil($this);
        }

        return $this;
    }

    public function removePharmacy(Pharmacie $pharmacy): self
    {
        if ($this->pharmacies->contains($pharmacy)) {
            $this->pharmacies->removeElement($pharmacy);
            $pharmacy->removeProfil($this);
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
            $centreDeSante->addProfil($this);
        }

        return $this;
    }

    public function removeCentreDeSante(CentreDeSante $centreDeSante): self
    {
        if ($this->centreDeSantes->contains($centreDeSante)) {
            $this->centreDeSantes->removeElement($centreDeSante);
            $centreDeSante->removeProfil($this);
        }

        return $this;
    }

    /**
     * @return Collection|MaladieChronique[]
     */
    public function getMaladieChroniques(): Collection
    {
        return $this->maladieChroniques;
    }

    public function addMaladieChronique(MaladieChronique $maladieChronique): self
    {
        if (!$this->maladieChroniques->contains($maladieChronique)) {
            $this->maladieChroniques[] = $maladieChronique;
            $maladieChronique->addProfil($this);
        }

        return $this;
    }

    public function removeMaladieChronique(MaladieChronique $maladieChronique): self
    {
        if ($this->maladieChroniques->contains($maladieChronique)) {
            $this->maladieChroniques->removeElement($maladieChronique);
            $maladieChronique->removeProfil($this);
        }

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
            $hopital->addProfil($this);
        }

        return $this;
    }

    public function removeHopital(Hopital $hopital): self
    {
        if ($this->hopitals->contains($hopital)) {
            $this->hopitals->removeElement($hopital);
            $hopital->removeProfil($this);
        }

        return $this;
    }
}
