<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\WhisperRepository")
 */
class Whisper
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
    private $whisp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isread;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="whispers")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $forPlayer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="whispers")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $toPlayer;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getWhisp(): ?string
    {
        return $this->whisp;
    }

    public function setWhisp(string $whisp): self
    {
        $this->whisp = $whisp;

        return $this;
    }

    public function getIsread(): ?bool
    {
        return $this->isread;
    }

    public function setIsread(bool $isread): self
    {
        $this->isread = $isread;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getForPlayer(): ?Player
    {
        return $this->forPlayer;
    }

    public function setForPlayer(?Player $forPlayer): self
    {
        $this->forPlayer = $forPlayer;

        return $this;
    }

    public function getToPlayer(): ?Player
    {
        return $this->toPlayer;
    }

    public function setToPlayer(?Player $toPlayer): self
    {
        $this->toPlayer = $toPlayer;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->forPlayer->getName() . ' - ' . $this->toPlayer->getName() . ' - ' . $this->id;
    }
}
