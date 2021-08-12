<?php

namespace App\Entity;

use App\Repository\TrailerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrailerRepository::class)
 */
class Trailer
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
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     */
    private $length;

    /**
     * @ORM\Column(type="array")
     */
    private $type = [];

    /**
     * @ORM\Column(type="date")
     */
    private $mot;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="trailer")
     */
    private  $trailerId;

    public function __construct()
    {
        $this->trailerId = new ArrayCollection();
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


    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getlength(): ?float
    {
        return $this->length;
    }

    public function setlength(float $length): self
    {
        $this->length = $length;

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
     * @return array
     */
    public function getType(): array
    {
        return $this->type;
    }

    /**
     * @param array $type
     */
    public function setType(array $type): void
    {
        $this->type = $type;
    }

    /**
     * @return ArrayCollection
     */
    public function getTrailerId(): ArrayCollection
    {
        return $this->trailerId;
    }

    /**
     * @param ArrayCollection $trailerId
     */
    public function setTrailerId(ArrayCollection $trailerId): void
    {
        $this->trailerId = $trailerId;
    }
}
