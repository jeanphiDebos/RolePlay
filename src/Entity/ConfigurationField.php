<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ConfigurationFieldRepository")
 */
class ConfigurationField
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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Universe", inversedBy="configurationFields")
     * @ORM\JoinColumn(nullable=false)
     */
    private $universe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FieldPlayer", mappedBy="configurationField", cascade={"remove"})
     */
    private $fieldPlayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FieldBestiary", mappedBy="configurationField", cascade={"remove"})
     */
    private $fieldBestiaries;

    public function __construct()
    {
        $this->fieldPlayers = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
     * @return Collection|FieldPlayer[]
     */
    public function getFieldPlayers(): Collection
    {
        return $this->fieldPlayers;
    }

    public function addFieldPlayer(FieldPlayer $fieldPlayer): self
    {
        if (!$this->fieldPlayers->contains($fieldPlayer)) {
            $this->fieldPlayers[] = $fieldPlayer;
            $fieldPlayer->setConfigurationField($this);
        }

        return $this;
    }

    public function removeFieldPlayer(FieldPlayer $fieldPlayer): self
    {
        if ($this->fieldPlayers->contains($fieldPlayer)) {
            $this->fieldPlayers->removeElement($fieldPlayer);
            // set the owning side to null (unless already changed)
            if ($fieldPlayer->getConfigurationField() === $this) {
                $fieldPlayer->setConfigurationField(null);
            }
        }

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
            $fieldBestiary->setConfigurationField($this);
        }

        return $this;
    }

    public function removeFieldBestiary(FieldBestiary $fieldBestiary): self
    {
        if ($this->fieldBestiaries->contains($fieldBestiary)) {
            $this->fieldBestiaries->removeElement($fieldBestiary);
            // set the owning side to null (unless already changed)
            if ($fieldBestiary->getConfigurationField() === $this) {
                $fieldBestiary->setConfigurationField(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }
}
