<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MapRepository")
 */
class Map
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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var File
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $display;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('mapper', 'cacher', 'visible')")
     */
    private $typeAffichage;

    /**
     * @ORM\Column(type="integer")
     */
    private $verticalAxis;

    /**
     * @ORM\Column(type="integer")
     */
    private $horizontalAxis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Universe", inversedBy="maps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $universe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MappingMap", mappedBy="map", cascade={"remove"})
     * @ApiSubresource(maxDepth=1)
     */
    private $mappingMaps;

    public function __construct()
    {
        $this->mappingMaps = new ArrayCollection();
        $this->typeAffichage = 'mapper';
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): self
    {
        $this->display = $display;

        return $this;
    }

    public function getTypeAffichage(): ?string
    {
        return $this->typeAffichage;
    }

    public function setTypeAffichage(string $typeAffichage): self
    {
        $this->typeAffichage = $typeAffichage;

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

    public function getUniverse(): ?Universe
    {
        return $this->universe;
    }

    public function setUniverse(?Universe $universe): self
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * @return Collection|MappingMap[]
     */
    public function getMappingMaps(): Collection
    {
        return $this->mappingMaps;
    }

    public function addMappingMap(MappingMap $mappingMap): self
    {
        if (!$this->mappingMaps->contains($mappingMap)) {
            $this->mappingMaps[] = $mappingMap;
            $mappingMap->setMap($this);
        }

        return $this;
    }

    public function removeMappingMap(MappingMap $mappingMap): self
    {
        if ($this->mappingMaps->contains($mappingMap)) {
            $this->mappingMaps->removeElement($mappingMap);
            // set the owning side to null (unless already changed)
            if ($mappingMap->getMap() === $this) {
                $mappingMap->setMap(null);
            }
        }

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
