<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 26/08/18
 * Time: 16:46
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * This is a dummy entity. Remove it!
 *
 * @ApiResource(forceEager=false, normalizationContext={"groups"={"site"}}, denormalizationContext={"groups"={"site"}})
 * @ORM\Entity(repositoryClass="SiteRepository")
 *
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
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"site"})
     */
    private $address;

    /**
     * @var ArrayCollection|MediaObject[]
     * @ORM\ManyToMany(targetEntity="App\Entity\MediaObject")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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

    /**
     * @return Collection|MediaObject[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(MediaObject $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    public function removeImage(MediaObject $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
        }

        return $this;
    }

}