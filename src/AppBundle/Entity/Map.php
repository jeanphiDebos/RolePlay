<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Map
 * @ORM\Entity()
 * @ORM\Table(name="map")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Map
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
     * @ORM\Column(name="picture", type="string", length=255, nullable=false)
     */
    protected $picture;
    /**
     * @var boolean
     * @ORM\Column(name="display", type="boolean", nullable=false)
     */
    protected $display;
    /**
     * @var DisplayType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DisplayType", inversedBy="maps")
     */
    protected $displayType;
    /**
     * @var int
     * @ORM\Column(name="vertical_axis", type="integer", nullable=false)
     */
    protected $verticalAxis;
    /**
     * @var int
     * @ORM\Column(name="horizontal_axis", type="integer", nullable=false)
     */
    protected $horizontalAxis;
    /**
     * @var Universe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universe", inversedBy="maps")
     */
    protected $universe;
    /**
     * @var MappingMap[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MappingMap", mappedBy="map")
     */
    protected $MappingMaps;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->MappingMaps = new ArrayCollection();
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
     * @return Map
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Map
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get display
     *
     * @return boolean
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set display
     *
     * @param boolean $display
     *
     * @return Map
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get verticalAxis
     *
     * @return integer
     */
    public function getVerticalAxis()
    {
        return $this->verticalAxis;
    }

    /**
     * Set verticalAxis
     *
     * @param integer $verticalAxis
     *
     * @return Map
     */
    public function setVerticalAxis($verticalAxis)
    {
        $this->verticalAxis = $verticalAxis;

        return $this;
    }

    /**
     * Get horizontalAxis
     *
     * @return integer
     */
    public function getHorizontalAxis()
    {
        return $this->horizontalAxis;
    }

    /**
     * Set horizontalAxis
     *
     * @param integer $horizontalAxis
     *
     * @return Map
     */
    public function setHorizontalAxis($horizontalAxis)
    {
        $this->horizontalAxis = $horizontalAxis;

        return $this;
    }

    /**
     * Get displayType
     *
     * @return \AppBundle\Entity\DisplayType
     */
    public function getDisplayType()
    {
        return $this->displayType;
    }

    /**
     * Set displayType
     *
     * @param \AppBundle\Entity\DisplayType $displayType
     *
     * @return Map
     */
    public function setDisplayType(\AppBundle\Entity\DisplayType $displayType = null)
    {
        $this->displayType = $displayType;

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
     * @return Map
     */
    public function setUniverse(\AppBundle\Entity\Universe $universe = null)
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * Add mappingMap
     *
     * @param \AppBundle\Entity\MappingMap $mappingMap
     *
     * @return Map
     */
    public function addMappingMap(\AppBundle\Entity\MappingMap $mappingMap)
    {
        $this->MappingMaps[] = $mappingMap;

        return $this;
    }

    /**
     * Remove mappingMap
     *
     * @param \AppBundle\Entity\MappingMap $mappingMap
     */
    public function removeMappingMap(\AppBundle\Entity\MappingMap $mappingMap)
    {
        $this->MappingMaps->removeElement($mappingMap);
    }

    /**
     * Get mappingMaps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMappingMaps()
    {
        return $this->MappingMaps;
    }
}
