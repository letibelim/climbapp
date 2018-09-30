<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 26/08/18
 * Time: 16:46
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 *
 * @ApiResource(forceEager=false, normalizationContext={"groups"={"site"}}, denormalizationContext={"groups"={"site"}})
 * @ORM\Entity(repositoryClass="SiteRepository")
 * @ORM\EntityListeners({"App\Listener\SiteListener"})
 */
class Site
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=512)
     * @Groups({"site"})
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups({"site"})
     */
    private $coordinates;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     * @Groups({"site"})
     */
    private $isKidFriendly = false;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"site"})
     */
    public $description;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", inversedBy="site", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"site"})
     */
    private $address;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Site
     */
    public function setName(string $name): Site
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    /**
     * @param string|null $coordinates
     *
     * @return Site
     */
    public function setCoordinates(?string $coordinates): Site
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    /**
     * @return bool
     */
    public function isKidFriendly(): bool
    {
        return $this->isKidFriendly;
    }

    /**
     * @param bool $isKidFriendly
     *
     * @return Site
     */
    public function setIsKidFriendly(bool $isKidFriendly): Site
    {
        $this->isKidFriendly = $isKidFriendly;
        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

}