<?php

namespace App\Entity;

use App\Repository\DriverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=DriverRepository::class)
 */
class Driver
{
    public function __toString()
    {
        return $this->getNames();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $names;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $driverLicense;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bankName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iban;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $egn;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="drivers")
     */
    private  $cargoes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="drivers")
     *
     */
    private  $company;


    public function __construct()
    {
        $this->cargoes = new ArrayCollection();

    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNames(): ?string
    {
        return $this->names;
    }

    public function setNames(string $names): self
    {
        $this->names = $names;

        return $this;
    }


    public function getDriverLicense(): ?string
    {
        return $this->driverLicense;
    }

    public function setDriverLicense(string $driverLicense): self
    {
        $this->driverLicense = $driverLicense;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getEgn(): ?string
    {
        return $this->egn;
    }

    public function setEgn(string $egn): self
    {
        $this->egn = $egn;

        return $this;
    }

    /**
     * @return Collection|Cargo[]
     */
    public function getCargoes(): ArrayCollection
    {
            return $this->cargoes;
    }

    /**
     * @param  $cargoes
     */
        public function setCargoes(ArrayCollection $cargoes)
    {
        $this->cargoes = $cargoes;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }


}
