<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    public function __toString()
    {
        return $this->getName();
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bulstat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner;

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
    private $bic;
    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="company")
     */
    private $employees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Driver" , mappedBy="company")
     */
    private $drivers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Customer" , mappedBy="customerCompany")
     */
    private $customers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Market" ,mappedBy="author")
     */
    private $offerOwner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking" , mappedBy="author")
     */
    private $bookOwner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proposal" , mappedBy="author")
     */
    private $companyProposal;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->companyProposal = new ArrayCollection();


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

    public function getBulstat(): ?string
    {
        return $this->bulstat;
    }

    public function setBulstat(string $bulstat): self
    {
        $this->bulstat = $bulstat;

        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(string $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param mixed $employees
     */
    public function setEmployees($employees): void
    {
        $this->employees = $employees;
    }

    /**
     * @return ArrayCollection
     */
    public function getDrivers(): ArrayCollection
    {
        return $this->drivers;
    }

    /**
     * @param ArrayCollection $drivers
     */
    public function setDrivers(ArrayCollection $drivers): void
    {
        $this->drivers = $drivers;
    }

    /**
     * @return ArrayCollection
     */
    public function getCustomers(): ArrayCollection
    {
        return $this->customers;
    }

    /**
     * @param ArrayCollection $customers
     */
    public function setCustomers(ArrayCollection $customers): void
    {
        $this->customers = $customers;
    }

    /**
     * @return mixed
     */
    public function getOfferOwner()
    {
        return $this->offerOwner;
    }

    /**
     * @param mixed $offerOwner
     */
    public function setOfferOwner($offerOwner): void
    {
        $this->offerOwner = $offerOwner;
    }

    /**
     * @return mixed
     */
    public function getCompanyProposal()
    {
        return $this->companyProposal;
    }

    /**
     * @param mixed $companyProposal
     */
    public function setCompanyProposal($companyProposal): void
    {
        $this->companyProposal = $companyProposal;
    }

    /**
     * @return mixed
     */
    public function getBookOwner()
    {
        return $this->bookOwner;
    }

    /**
     * @param mixed $bookOwner
     */
    public function setBookOwner($bookOwner): void
    {
        $this->bookOwner = $bookOwner;
    }

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param mixed $bankName
     */
    public function setBankName($bankName): void
    {
        $this->bankName = $bankName;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param mixed $iban
     */
    public function setIban($iban): void
    {
        $this->iban = $iban;
    }

    /**
     * @return mixed
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param mixed $bic
     */
    public function setBic($bic): void
    {
        $this->bic = $bic;
    }


}
