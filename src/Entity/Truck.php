<?php

namespace App\Entity;

use App\Repository\TruckRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TruckRepository::class)
 */
class Truck
{
    public function __toString()
    {
        return $this->getIdentifier();
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
    private $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="float")
     */
    private $consumption;

    /**
     * @ORM\Column(type="date")
     */
    private $mot;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="truck")
     */
    private  $truckId;

    public function __construct()
    {
        $this->truckId = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getmodel(): ?string
    {
        return $this->model;
    }

    public function setmodel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getConsumption(): ?float
    {
        return $this->consumption;
    }

    public function setConsumption(float $consumption): self
    {
        $this->consumption = $consumption;

        return $this;
    }

    public function getMot(): ?\DateTimeInterface
    {
        return $this->mot;
    }

    public function setMot(\DateTimeInterface $mot): self
    {
        $this->mot = $mot;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTruckId(): ArrayCollection
    {
        return $this->truckId;
    }

    /**
     * @param  $truckId
     */
    public function setTruckId(ArrayCollection $truckId)
    {
        $this->truckId = $truckId;
    }
}
