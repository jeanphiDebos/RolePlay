<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FieldBestiaryRepository")
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="field_player_unique", columns={"configuration_field_id", "bestiary_id"})})
 */
class FieldBestiary
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ConfigurationField", inversedBy="fieldBestiaries")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $configurationField;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bestiary", inversedBy="fieldBestiaries")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    private $bestiary;

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

    public function getBestiary(): ?Bestiary
    {
        return $this->bestiary;
    }

    public function setBestiary(?Bestiary $bestiary): self
    {
        $this->bestiary = $bestiary;

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
        return (string)$this->bestiary->getName() . ' - ' . (string)$this->configurationField->getName();
    }
}
