<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MappingMapRepository")
 */
class MappingMap
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Map", inversedBy="mappingMaps")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $map;

    /**
     * @ORM\Column(type="integer")
     */
    private $verticalAxis;

    /**
     * @ORM\Column(type="integer")
     */
    private $horizontalAxis;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(?Map $map): self
    {
        $this->map = $map;

        return $this;
    }

    public function getVerticalAxis(): ?int
    {
        return $this->verticalAxis;
    }

    public function setVerticalAxis(int $verticalAxis): self
    {
        $this->verticalAxis = $verticalAxis;

        return $this;
    }

    public function getHorizontalAxis(): ?int
    {
        return $this->horizontalAxis;
    }

    public function setHorizontalAxis(int $horizontalAxis): self
    {
        $this->horizontalAxis = $horizontalAxis;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->map->getName() . ' - ' . $this->id;
    }
}
