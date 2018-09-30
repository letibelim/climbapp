<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Validator\Constraints as AppConstraint;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClimbingRouteRepository")
 */
class ClimbingRoute
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     * @AppConstraint\Cotation()
     */
    private $cotation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMultiPitch = false;

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

    public function getCotation(): ?string
    {
        return $this->cotation;
    }

    public function setCotation(string $cotation): self
    {
        $this->cotation = $cotation;

        return $this;
    }

    public function getIsMultiPitch(): ?bool
    {
        return $this->isMultiPitch;
    }

    public function setIsMultiPitch(bool $isMultiPitch): self
    {
        $this->isMultiPitch = $isMultiPitch;

        return $this;
    }
}
