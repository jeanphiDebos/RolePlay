<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PathfinderBestiaryRepository")
 */
class PathfinderBestiary
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $info;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $sheet;

    /**
     * @var File
     */
    private $imageFile;

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

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
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

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return string
     */
    public function getSheet()
    {
        return $this->sheet;
    }

    /**
     * @param string $sheet
     */
    public function setSheet($sheet)
    {
        $this->sheet = $sheet;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->sheet;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->sheet = $image;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->name;
    }
}
