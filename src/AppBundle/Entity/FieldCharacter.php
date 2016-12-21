<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FieldCharacter
 * @ORM\Entity()
 * @ORM\Table(name="field_character")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FieldCharacter
{
    /**
     * @var ConfigurationField
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ConfigurationField", inversedBy="fieldCharacters")
     */
    protected $configurationField;
    /**
     * @var Character
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Character", inversedBy="fieldCharacters")
     */
    protected $character;
    /**
     * @var string
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    protected $value;

    /**
     * constructor.
     */
    public function __construct()
    {

    }

    /**
     *
     */
    public function __destruct()
    {

    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return FieldCharacter
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get configurationField
     *
     * @return \AppBundle\Entity\ConfigurationField
     */
    public function getConfigurationField()
    {
        return $this->configurationField;
    }

    /**
     * Set configurationField
     *
     * @param \AppBundle\Entity\ConfigurationField $configurationField
     *
     * @return FieldCharacter
     */
    public function setConfigurationField(\AppBundle\Entity\ConfigurationField $configurationField)
    {
        $this->configurationField = $configurationField;

        return $this;
    }

    /**
     * Get character
     *
     * @return \AppBundle\Entity\Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set character
     *
     * @param \AppBundle\Entity\Character $character
     *
     * @return FieldCharacter
     */
    public function setCharacter(\AppBundle\Entity\Character $character)
    {
        $this->character = $character;

        return $this;
    }
}
