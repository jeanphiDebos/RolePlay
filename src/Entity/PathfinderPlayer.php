<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PathfinderPlayerRepository")
 */
class PathfinderPlayer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $lifePoint;

    /**
     * @ORM\Column(type="integer")
     */
    private $initiation;

    public function __construct()
    {
        $this->level = 0;
        $this->lifePoint = 0;
        $this->initiation = 0;
    }

    public function getId(): ?string
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

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLifePoint(): ?string
    {
        return $this->lifePoint;
    }

    public function setLifePoint(string $lifePoint): self
    {
        $this->lifePoint = $lifePoint;

        return $this;
    }

    public function getInitiation(): ?string
    {
        return $this->initiation;
    }

    public function setInitiation(string $initiation): self
    {
        $this->initiation = $initiation;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->name;
    }
}
