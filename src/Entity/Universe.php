<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UniverseRepository")
 */
class Universe
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
     * @ORM\Column(type="boolean")
     */
    private $display;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="universe", cascade={"remove"}, orphanRemoval=true)
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bestiary", mappedBy="universe", cascade={"remove"})
     */
    private $bestiaries;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ConfigurationField", mappedBy="universe", cascade={"remove"})
     */
    private $configurationFields;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Map", mappedBy="universe", cascade={"remove"})
     */
    private $maps;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->bestiaries = new ArrayCollection();
        $this->configurationFields = new ArrayCollection();
        $this->maps = new ArrayCollection();
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

    public function getDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): self
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setUniverse($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getUniverse() === $this) {
                $player->setUniverse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bestiary[]
     */
    public function getBestiaries(): Collection
    {
        return $this->bestiaries;
    }

    public function addBestiary(Bestiary $bestiary): self
    {
        if (!$this->bestiaries->contains($bestiary)) {
            $this->bestiaries[] = $bestiary;
            $bestiary->setUniverse($this);
        }

        return $this;
    }

    public function removeBestiary(Bestiary $bestiary): self
    {
        if ($this->bestiaries->contains($bestiary)) {
            $this->bestiaries->removeElement($bestiary);
            // set the owning side to null (unless already changed)
            if ($bestiary->getUniverse() === $this) {
                $bestiary->setUniverse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConfigurationField[]
     */
    public function getConfigurationFields(): Collection
    {
        return $this->configurationFields;
    }

    public function addConfigurationField(ConfigurationField $configurationField): self
    {
        if (!$this->configurationFields->contains($configurationField)) {
            $this->configurationFields[] = $configurationField;
            $configurationField->setUniverse($this);
        }

        return $this;
    }

    public function removeConfigurationField(ConfigurationField $configurationField): self
    {
        if ($this->configurationFields->contains($configurationField)) {
            $this->configurationFields->removeElement($configurationField);
            // set the owning side to null (unless already changed)
            if ($configurationField->getUniverse() === $this) {
                $configurationField->setUniverse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Map[]
     */
    public function getMaps(): Collection
    {
        return $this->maps;
    }

    public function addMap(Map $map): self
    {
        if (!$this->maps->contains($map)) {
            $this->maps[] = $map;
            $map->setUniverse($this);
        }

        return $this;
    }

    public function removeMap(Map $map): self
    {
        if ($this->maps->contains($map)) {
            $this->maps->removeElement($map);
            // set the owning side to null (unless already changed)
            if ($map->getUniverse() === $this) {
                $map->setUniverse(null);
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
