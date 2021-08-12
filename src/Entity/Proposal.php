<?php

namespace App\Entity;

use App\Repository\ProposalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposalRepository::class)
 */
class Proposal
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $proposalPrice;

    /**
     * @ORM\Column(type="date")
     */
    private $proposalLoadingDate;

    /**
     * @ORM\Column(type="date")
     */
    private $proposalUnloadingDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAccepted;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Market", inversedBy="offers")
     */
    private Market $market;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="companyProposal")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Market", inversedBy="marketproposals",cascade={"persist"})
     * @ORM\JoinColumn(name="author", referencedColumnName="author")
     */
    private $markets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="proposals")
     */
    private  $myProposals;

    public function __construct()
    {
        $this->markets = new ArrayCollection();
        $this->myProposals = new ArrayCollection();

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
    public function getProposalPrice()
    {
        return $this->proposalPrice;
    }

    /**
     * @param mixed $proposalPrice
     */
    public function setProposalPrice($proposalPrice): void
    {
        $this->proposalPrice = $proposalPrice;
    }

    /**
     * @return mixed
     */
    public function getProposalLoadingDate()
    {
        return $this->proposalLoadingDate;
    }

    /**
     * @param mixed $proposalLoadingDate
     */
    public function setProposalLoadingDate($proposalLoadingDate): void
    {
        $this->proposalLoadingDate = $proposalLoadingDate;
    }

    /**
     * @return mixed
     */
    public function getProposalUnloadingDate()
    {
        return $this->proposalUnloadingDate;
    }

    /**
     * @param mixed $proposalUnloadingDate
     */
    public function setProposalUnloadingDate($proposalUnloadingDate): void
    {
        $this->proposalUnloadingDate = $proposalUnloadingDate;
    }

    /**
     * @return Market
     */
    public function getMarket(): Market
    {
        return $this->market;
    }

    /**
     * @param Market $market
     */
    public function setMarket(Market $market): void
    {
        $this->market = $market;
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
     * @return ArrayCollection
     */
    public function getMarkets(): ArrayCollection
    {
        return $this->markets;
    }

    /**
     * @param ArrayCollection $markets
     */
    public function setMarkets(ArrayCollection $markets): void
    {
        $this->markets = $markets;
    }

    /**
     * @return ArrayCollection
     */
    public function getMyProposals(): ArrayCollection
    {
        return $this->myProposals;
    }

    /**
     * @param ArrayCollection $myProposals
     */
    public function setMyProposals(ArrayCollection $myProposals): void
    {
        $this->myProposals = $myProposals;
    }

    /**
     * @return mixed
     */
    public function getIsAccepted()
    {
        return $this->isAccepted;
    }

    /**
     * @param mixed $isAccepted
     */
    public function setIsAccepted($isAccepted): void
    {
        $this->isAccepted = $isAccepted;
    }


}