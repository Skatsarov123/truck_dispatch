<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="bookOwner")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Market", inversedBy="personalMarket")
     *
     */
    private $market;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proposal", inversedBy="myProposals")
     *
     */
    private $proposals;

    /**
     * @var Status
     * @ORM\ManyToOne(targetEntity="App\Entity\Status",inversedBy="myStatus")
     */
    private Status $status;
    /**
     * @var Driver
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Driver",inversedBy="cargoes")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Driver $drivers = null;

    /**
     * @var Truck
     * @ORM\ManyToOne(targetEntity="App\Entity\Truck",inversedBy="truckId")
     */
    private ?Truck $truck = null;
    /**
     * @var Trailer
     * @ORM\ManyToOne(targetEntity="App\Entity\Trailer",inversedBy="trailerId")
     */
    private ?Trailer $trailer = null;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer",inversedBy="customerId")
     */
    private ?Customer $customer = null;

    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Invoice", mappedBy="bookingId")
     *
     */
    private $invoice;

    public function __construct()
    {
        $this->invoice = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * @param mixed $market
     */
    public function setMarket($market): void
    {
        $this->market = $market;
    }

    /**
     * @return mixed
     */
    public function getProposals()
    {
        return $this->proposals;
    }

    /**
     * @param mixed $proposals
     */
    public function setProposals($proposals): void
    {
        $this->proposals = $proposals;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Driver
     */
    public function getDrivers(): ?Driver
    {
        return $this->drivers;
    }

    /**
     * @param Driver $drivers
     */
    public function setDrivers(?Driver $drivers): void
    {
        $this->drivers = $drivers;
    }

    /**
     * @return Truck
     */
    public function getTruck(): ?Truck
    {
        return $this->truck;
    }

    /**
     * @param Truck $truck
     */
    public function setTruck(?Truck $truck): void
    {
        $this->truck = $truck;
    }

    /**
     * @return Trailer
     */
    public function getTrailer(): ?Trailer
    {
        return $this->trailer;
    }

    /**
     * @param Trailer $trailer
     */
    public function setTrailer(?Trailer $trailer): void
    {
        $this->trailer = $trailer;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }


    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getMarketproposals()
    {
        return $this->marketproposals;
    }

    /**
     * @param mixed $marketproposals
     */
    public function setMarketproposals($marketproposals): void
    {
        $this->marketproposals = $marketproposals;
    }

    /**
     * @return ArrayCollection
     */
    public function getInvoice(): ArrayCollection
    {
        return $this->invoice;
    }

    /**
     * @param ArrayCollection $invoice
     */
    public function setInvoice(ArrayCollection $invoice): void
    {
        $this->invoice = $invoice;
    }


}