<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ship
 * @ORM\Entity()
 * @ORM\Table(name="ship")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Ship
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
     * @ORM\Column(name="player_ship", type="boolean", nullable=false)
     */
    protected $playerShip;
    /**
     * @var ShipType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShipType", inversedBy="Ships")
     */
    protected $type;
    /**
     * @var int
     * @ORM\Column(name="crew", type="integer", nullable=false)
     */
    protected $crew;
    /**
     * @var int
     * @ORM\Column(name="shell", type="integer", nullable=false)
     */
    protected $shell;
    /**
     * @var int
     * @ORM\Column(name="canon", type="integer", nullable=false)
     */
    protected $canon;
    /**
     * @var int
     * @ORM\Column(name="cannonball", type="integer", nullable=false)
     */
    protected $cannonball;
    /**
     * @var Universe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universe", inversedBy="ships")
     */
    protected $universe;

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
     * @return Ship
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
     * @return Ship
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get playerShip
     *
     * @return boolean
     */
    public function getPlayerShip()
    {
        return $this->playerShip;
    }

    /**
     * Set playerShip
     *
     * @param boolean $playerShip
     *
     * @return Ship
     */
    public function setPlayerShip($playerShip)
    {
        $this->playerShip = $playerShip;

        return $this;
    }

    /**
     * Get crew
     *
     * @return integer
     */
    public function getCrew()
    {
        return $this->crew;
    }

    /**
     * Set crew
     *
     * @param integer $crew
     *
     * @return Ship
     */
    public function setCrew($crew)
    {
        $this->crew = $crew;

        return $this;
    }

    /**
     * Get shell
     *
     * @return integer
     */
    public function getShell()
    {
        return $this->shell;
    }

    /**
     * Set shell
     *
     * @param integer $shell
     *
     * @return Ship
     */
    public function setShell($shell)
    {
        $this->shell = $shell;

        return $this;
    }

    /**
     * Get canon
     *
     * @return integer
     */
    public function getCanon()
    {
        return $this->canon;
    }

    /**
     * Set canon
     *
     * @param integer $canon
     *
     * @return Ship
     */
    public function setCanon($canon)
    {
        $this->canon = $canon;

        return $this;
    }

    /**
     * Get cannonball
     *
     * @return integer
     */
    public function getCannonball()
    {
        return $this->cannonball;
    }

    /**
     * Set cannonball
     *
     * @param integer $cannonball
     *
     * @return Ship
     */
    public function setCannonball($cannonball)
    {
        $this->cannonball = $cannonball;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\ShipType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\ShipType $type
     *
     * @return Ship
     */
    public function setType(\AppBundle\Entity\ShipType $type = null)
    {
        $this->type = $type;

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
     * @return Ship
     */
    public function setUniverse(\AppBundle\Entity\Universe $universe = null)
    {
        $this->universe = $universe;

        return $this;
    }
}
