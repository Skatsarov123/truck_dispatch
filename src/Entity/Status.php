<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
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
     * @ORM\OneToMany(targetEntity="App\Entity\Market", mappedBy="status")
     */
    private  $bookStatus;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="status")
     */
    private  $myStatus;

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

    /**
     * @return mixed
     */
    public function getBookStatus()
    {
        return $this->bookStatus;
    }

    /**
     * @param mixed $bookStatus
     */
    public function setBookStatus($bookStatus): void
    {
        $this->bookStatus = $bookStatus;
    }

    /**
     * @return mixed
     */
    public function getMyStatus()
    {
        return $this->myStatus;
    }

    /**
     * @param mixed $myStatus
     */
    public function setMyStatus($myStatus): void
    {
        $this->myStatus = $myStatus;
    }
}
