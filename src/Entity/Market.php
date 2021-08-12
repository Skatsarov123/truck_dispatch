<?php

namespace App\Entity;

use App\Repository\MarketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarketRepository::class)
 */
class Market
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $loadingDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loadingCountry;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loadingZip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loadingTown;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loadingStreet;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unloadingCounty;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unloadingZip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unloadingTown;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unloadingStreet;
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $distance;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $cargoWeight;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $cargoHeight;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $cargoLength;

    /**
     * @ORM\Column(type="array")
     */
    private $cargoType = [];

    /**
     * @ORM\Column(type="array")
     */
    private $trailerType = [];


    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proposal", mappedBy="market")
     */
    private $offers;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Company", inversedBy="offerOwner")
     */
    private $author;


    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Status",inversedBy="bookStatus")
     *
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Proposal", mappedBy="markets",cascade={"persist"})
     */
    private $marketproposals;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="market")
     */
    private $personalMarket;


    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->marketproposals = new ArrayCollection();
        $this->personalMarket = new ArrayCollection();

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
    public function getLoadingDate()
    {
        return $this->loadingDate;
    }

    /**
     * @param mixed $loadingDate
     */
    public function setLoadingDate($loadingDate): void
    {
        $this->loadingDate = $loadingDate;
    }

    /**
     * @return mixed
     */
    public function getLoadingCountry()
    {
        return $this->loadingCountry;
    }

    /**
     * @param mixed $loadingCountry
     */
    public function setLoadingCountry($loadingCountry): void
    {
        $this->loadingCountry = $loadingCountry;
    }

    /**
     * @return mixed
     */
    public function getLoadingZip()
    {
        return $this->loadingZip;
    }

    /**
     * @param mixed $loadingZip
     */
    public function setLoadingZip($loadingZip): void
    {
        $this->loadingZip = $loadingZip;
    }

    /**
     * @return mixed
     */
    public function getLoadingTown()
    {
        return $this->loadingTown;
    }

    /**
     * @param mixed $loadingTown
     */
    public function setLoadingTown($loadingTown): void
    {
        $this->loadingTown = $loadingTown;
    }

    /**
     * @return mixed
     */
    public function getLoadingStreet()
    {
        return $this->loadingStreet;
    }

    /**
     * @param mixed $loadingStreet
     */
    public function setLoadingStreet($loadingStreet): void
    {
        $this->loadingStreet = $loadingStreet;
    }

    /**
     * @return mixed
     */
    public function getUnloadingCounty()
    {
        return $this->unloadingCounty;
    }

    /**
     * @param mixed $unloadingCounty
     */
    public function setUnloadingCounty($unloadingCounty): void
    {
        $this->unloadingCounty = $unloadingCounty;
    }

    /**
     * @return mixed
     */
    public function getUnloadingZip()
    {
        return $this->unloadingZip;
    }

    /**
     * @param mixed $unloadingZip
     */
    public function setUnloadingZip($unloadingZip): void
    {
        $this->unloadingZip = $unloadingZip;
    }

    /**
     * @return mixed
     */
    public function getUnloadingTown()
    {
        return $this->unloadingTown;
    }

    /**
     * @param mixed $unloadingTown
     */
    public function setUnloadingTown($unloadingTown): void
    {
        $this->unloadingTown = $unloadingTown;
    }

    /**
     * @return mixed
     */
    public function getUnloadingStreet()
    {
        return $this->unloadingStreet;
    }

    /**
     * @param mixed $unloadingStreet
     */
    public function setUnloadingStreet($unloadingStreet): void
    {
        $this->unloadingStreet = $unloadingStreet;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getCargoWeight()
    {
        return $this->cargoWeight;
    }

    /**
     * @param mixed $cargoWeight
     */
    public function setCargoWeight($cargoWeight): void
    {
        $this->cargoWeight = $cargoWeight;
    }

    /**
     * @return mixed
     */
    public function getCargoHeight()
    {
        return $this->cargoHeight;
    }

    /**
     * @param mixed $cargoHeight
     */
    public function setCargoHeight($cargoHeight): void
    {
        $this->cargoHeight = $cargoHeight;
    }

    /**
     * @return mixed
     */
    public function getCargoLength()
    {
        return $this->cargoLength;
    }

    /**
     * @param mixed $cargoLength
     */
    public function setCargoLength($cargoLength): void
    {
        $this->cargoLength = $cargoLength;
    }

    /**
     * @return array
     */
    public function getCargoType(): array
    {
        return $this->cargoType;
    }

    /**
     * @param array $cargoType
     */
    public function setCargoType(array $cargoType): void
    {
        $this->cargoType = $cargoType;
    }

    /**
     * @return array
     */
    public function getTrailerType(): array
    {
        return $this->trailerType;
    }

    /**
     * @param array $trailerType
     */
    public function setTrailerType(array $trailerType): void
    {
        $this->trailerType = $trailerType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return ArrayCollection
     */
    public function getOffers(): ArrayCollection
    {
        return $this->offers;
    }

    /**
     * @param ArrayCollection $offers
     */
    public function setOffers(ArrayCollection $offers): void
    {
        $this->offers = $offers;
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
     * @return ArrayCollection
     */
    public function getMarketproposals(): ArrayCollection
    {
        return $this->marketproposals;
    }

    /**
     * @param ArrayCollection $marketproposals
     */
    public function setMarketproposals(ArrayCollection $marketproposals): void
    {
        $this->marketproposals = $marketproposals;
    }

    /**
     * @return ArrayCollection
     */
    public function getPersonalMarket(): ArrayCollection
    {
        return $this->personalMarket;
    }

    /**
     * @param ArrayCollection $personalMarket
     */
    public function setPersonalMarket(ArrayCollection $personalMarket): void
    {
        $this->personalMarket = $personalMarket;
    }



}
