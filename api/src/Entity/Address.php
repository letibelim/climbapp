<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 * @ORM\EntityListeners({"App\Listener\AddressListener"})
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"site"})
     */
    private $line1 = '';

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"site"})
     */
    private $line2 = '';

    /**
     * @ORM\Column(type="string", length=16)
     * @Groups({"site"})
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups({"site"})
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups({"site"})
     */
    private $country;


    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $coordinates;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLine1(): string
    {
        return $this->line1;
    }

    public function setLine1(string $line1): self
    {
        $this->line1 = $line1;

        return $this;
    }

    public function getLine2(): string
    {
        return $this->line2;
    }

    public function setLine2(string $line2): self
    {
        $this->line2 = $line2;

        return $this;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function __toString()
    {
        return $this->getLine1() . ' ' . $this->getLine2() . ' ' . $this->getPostcode() . ' ' . $this->getTown() . ' ' . $this->getCountry();
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(?string $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }
}
