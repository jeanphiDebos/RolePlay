<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ConfigurationField
 * @ORM\Entity()
 * @ORM\Table(name="configuration_field")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ConfigurationField
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;
    /**
     * @var ConfigurationFieldType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ConfigurationFieldType", inversedBy="configurationFields")
     */
    protected $type;
    /**
     * @var ConfigurationFieldFor
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ConfigurationFieldFor", inversedBy="configurationFields")
     */
    protected $for;
    /**
     * @var Universe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universe", inversedBy="configurationFields")
     */
    protected $universe;
    /**
     * @var FieldBestiary[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FieldBestiary", mappedBy="configurationField")
     */
    protected $fieldBestiarys;
    /**
     * @var FieldCharacter[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FieldCharacter", mappedBy="configurationField")
     */
    protected $fieldCharacters;


    /**
     * constructor.
     */
    public function __construct()
    {
        $this->fieldBestiarys = new ArrayCollection();
        $this->fieldCharacters = new ArrayCollection();
    }

    /**
     *
     */
    public function __destruct()
    {

    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ConfigurationField
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ConfigurationField
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\ConfigurationFieldType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\ConfigurationFieldType $type
     *
     * @return ConfigurationField
     */
    public function setType(\AppBundle\Entity\ConfigurationFieldType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get for
     *
     * @return \AppBundle\Entity\ConfigurationFieldFor
     */
    public function getFor()
    {
        return $this->for;
    }

    /**
     * Set for
     *
     * @param \AppBundle\Entity\ConfigurationFieldFor $for
     *
     * @return ConfigurationField
     */
    public function setFor(\AppBundle\Entity\ConfigurationFieldFor $for = null)
    {
        $this->for = $for;

        return $this;
    }

    /**
     * Get universe
     *
     * @return \AppBundle\Entity\Universe
     */
    public function getUniverse()
    {
        return $this->universe;
    }

    /**
     * Set universe
     *
     * @param \AppBundle\Entity\Universe $universe
     *
     * @return ConfigurationField
     */
    public function setUniverse(\AppBundle\Entity\Universe $universe = null)
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * Add fieldBestiary
     *
     * @param \AppBundle\Entity\FieldBestiary $fieldBestiary
     *
     * @return ConfigurationField
     */
    public function addFieldBestiary(\AppBundle\Entity\FieldBestiary $fieldBestiary)
    {
        $this->fieldBestiarys[] = $fieldBestiary;

        return $this;
    }

    /**
     * Remove fieldBestiary
     *
     * @param \AppBundle\Entity\FieldBestiary $fieldBestiary
     */
    public function removeFieldBestiary(\AppBundle\Entity\FieldBestiary $fieldBestiary)
    {
        $this->fieldBestiarys->removeElement($fieldBestiary);
    }

    /**
     * Get fieldBestiarys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFieldBestiarys()
    {
        return $this->fieldBestiarys;
    }

    /**
     * Add fieldCharacter
     *
     * @param \AppBundle\Entity\FieldCharacter $fieldCharacter
     *
     * @return ConfigurationField
     */
    public function addFieldCharacter(\AppBundle\Entity\FieldCharacter $fieldCharacter)
    {
        $this->fieldCharacters[] = $fieldCharacter;

        return $this;
    }

    /**
     * Remove fieldCharacter
     *
     * @param \AppBundle\Entity\FieldCharacter $fieldCharacter
     */
    public function removeFieldCharacter(\AppBundle\Entity\FieldCharacter $fieldCharacter)
    {
        $this->fieldCharacters->removeElement($fieldCharacter);
    }

    /**
     * Get fieldCharacters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFieldCharacters()
    {
        return $this->fieldCharacters;
    }
}
