<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FieldBestiary
 * @ORM\Entity()
 * @ORM\Table(name="field_bestiary")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FieldBestiary
{
    /**
     * @var ConfigurationField
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ConfigurationField", inversedBy="fieldBestiarys")
     */
    protected $configurationField;
    /**
     * @var Bestiary
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Bestiary", inversedBy="fieldBestiarys")
     */
    protected $bestiary;
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
     * @return FieldBestiary
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
     * @return FieldBestiary
     */
    public function setConfigurationField(\AppBundle\Entity\ConfigurationField $configurationField)
    {
        $this->configurationField = $configurationField;

        return $this;
    }

    /**
     * Get bestiary
     *
     * @return \AppBundle\Entity\Bestiary
     */
    public function getBestiary()
    {
        return $this->bestiary;
    }

    /**
     * Set bestiary
     *
     * @param \AppBundle\Entity\Bestiary $bestiary
     *
     * @return FieldBestiary
     */
    public function setBestiary(\AppBundle\Entity\Bestiary $bestiary)
    {
        $this->bestiary = $bestiary;

        return $this;
    }
}
