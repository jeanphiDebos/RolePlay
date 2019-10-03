<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FieldPlayerRepository")
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="field_player_unique", columns={"configuration_field_id", "player_id"})})
 */
class FieldPlayer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ConfigurationField", inversedBy="fieldPlayers")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $configurationField;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="fieldPlayers")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $player;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getConfigurationField(): ?ConfigurationField
    {
        return $this->configurationField;
    }

    public function setConfigurationField(?ConfigurationField $configurationField): self
    {
        $this->configurationField = $configurationField;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->player->getName() . ' - ' . (string)$this->configurationField->getName();
    }
}
