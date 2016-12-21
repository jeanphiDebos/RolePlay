<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MappingMap
 * @ORM\Entity()
 * @ORM\Table(name="mapping_map")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MappingMap
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var Map
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Map", inversedBy="MappingMaps")
     */
    protected $map;
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * @return MappingMap
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
     * @return MappingMap
     */
    public function setHorizontalAxis($horizontalAxis)
    {
        $this->horizontalAxis = $horizontalAxis;

        return $this;
    }

    /**
     * Get map
     *
     * @return \AppBundle\Entity\Map
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set map
     *
     * @param \AppBundle\Entity\Map $map
     *
     * @return MappingMap
     */
    public function setMap(\AppBundle\Entity\Map $map)
    {
        $this->map = $map;

        return $this;
    }
}
