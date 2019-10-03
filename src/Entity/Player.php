<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Universe", inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $universe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FieldPlayer", mappedBy="player")
     * @ApiSubresource(maxDepth=1)
     */
    private $fieldPlayers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Whisper", mappedBy="forPlayer")
     * @ApiSubresource(maxDepth=1)
     */
    private $whispers;

    public function __construct()
    {
        $this->fieldPlayers = new ArrayCollection();
        $this->whispers = new ArrayCollection();
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

    public function getUniverse(): ?Universe
    {
        return $this->universe;
    }

    public function setUniverse(?Universe $universe): self
    {
        $this->universe = $universe;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

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
            $fieldPlayer->setPlayer($this);
        }

        return $this;
    }

    public function removeFieldPlayer(FieldPlayer $fieldPlayer): self
    {
        if ($this->fieldPlayers->contains($fieldPlayer)) {
            $this->fieldPlayers->removeElement($fieldPlayer);
            // set the owning side to null (unless already changed)
            if ($fieldPlayer->getPlayer() === $this) {
                $fieldPlayer->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Whisper[]
     */
    public function getWhispers(): Collection
    {
        return $this->whispers;
    }

    public function addWhisper(Whisper $whisper): self
    {
        if (!$this->whispers->contains($whisper)) {
            $this->whispers[] = $whisper;
            $whisper->setForPlayer($this);
        }

        return $this;
    }

    public function removeWhisper(Whisper $whisper): self
    {
        if ($this->whispers->contains($whisper)) {
            $this->whispers->removeElement($whisper);
            // set the owning side to null (unless already changed)
            if ($whisper->getForPlayer() === $this) {
                $whisper->setForPlayer(null);
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
