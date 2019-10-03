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
 * @ORM\Entity(repositoryClass="App\Repository\BestiaryRepository")
 */
class Bestiary
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var File
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hide;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Universe", inversedBy="bestiaries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $universe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FieldBestiary", mappedBy="bestiary")
     * @ApiSubresource(maxDepth=1)
     */
    private $fieldBestiaries;

    public function __construct()
    {
        $this->fieldBestiaries = new ArrayCollection();
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

    public function getHide(): ?bool
    {
        return $this->hide;
    }

    public function setHide(bool $hide): self
    {
        $this->hide = $hide;

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
     * @return Collection|FieldBestiary[]
     */
    public function getFieldBestiaries(): Collection
    {
        return $this->fieldBestiaries;
    }

    public function addFieldBestiary(FieldBestiary $fieldBestiary): self
    {
        if (!$this->fieldBestiaries->contains($fieldBestiary)) {
            $this->fieldBestiaries[] = $fieldBestiary;
            $fieldBestiary->setBestiary($this);
        }

        return $this;
    }

    public function removeFieldBestiary(FieldBestiary $fieldBestiary): self
    {
        if ($this->fieldBestiaries->contains($fieldBestiary)) {
            $this->fieldBestiaries->removeElement($fieldBestiary);
            // set the owning side to null (unless already changed)
            if ($fieldBestiary->getBestiary() === $this) {
                $fieldBestiary->setBestiary(null);
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
