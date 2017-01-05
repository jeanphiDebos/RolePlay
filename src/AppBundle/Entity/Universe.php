<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Universe
 * @ORM\Entity()
 * @ORM\Table(name="universe")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Universe
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
     * @var boolean
     * @ORM\Column(name="display", type="boolean", nullable=false)
     */
    protected $display;
    /**
     * @var ConfigurationField[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ConfigurationField", mappedBy="universe")
     */
    protected $configurationFields;
    /**
     * @var Map[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Map", mappedBy="universe")
     */
    protected $maps;
    /**
     * @var Character[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Character", mappedBy="universe")
     */
    protected $characters;
    /**
     * @var Bestiary[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bestiary", mappedBy="universe")
     */
    protected $bestiarys;
    /**
     * @var Ship[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ship", mappedBy="universe")
     */
    protected $ships;
    /**
     * @var Module[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Module", mappedBy="universes")
     * @ORM\JoinTable(name="active_module",
     *      joinColumns={@ORM\JoinColumn(name="universe_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="module_id", referencedColumnName="id")}
     * )
     */
    protected $modules;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->configurationFields = new ArrayCollection();
        $this->maps = new ArrayCollection();
        $this->ships = new ArrayCollection();
        $this->modules = new ArrayCollection();
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
     * @return Universe
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @return Universe
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Add configurationField
     *
     * @param \AppBundle\Entity\ConfigurationField $configurationField
     *
     * @return Universe
     */
    public function addConfigurationField(\AppBundle\Entity\ConfigurationField $configurationField)
    {
        $this->configurationFields[] = $configurationField;

        return $this;
    }

    /**
     * Remove configurationField
     *
     * @param \AppBundle\Entity\ConfigurationField $configurationField
     */
    public function removeConfigurationField(\AppBundle\Entity\ConfigurationField $configurationField)
    {
        $this->configurationFields->removeElement($configurationField);
    }

    /**
     * Get configurationFields
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConfigurationFields()
    {
        return $this->configurationFields;
    }

    /**
     * Add map
     *
     * @param \AppBundle\Entity\Map $map
     *
     * @return Universe
     */
    public function addMap(\AppBundle\Entity\Map $map)
    {
        $this->maps[] = $map;

        return $this;
    }

    /**
     * Remove map
     *
     * @param \AppBundle\Entity\Map $map
     */
    public function removeMap(\AppBundle\Entity\Map $map)
    {
        $this->maps->removeElement($map);
    }

    /**
     * Get maps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaps()
    {
        return $this->maps;
    }

    /**
     * Add ship
     *
     * @param \AppBundle\Entity\Ship $ship
     *
     * @return Universe
     */
    public function addShip(\AppBundle\Entity\Ship $ship)
    {
        $this->ships[] = $ship;

        return $this;
    }

    /**
     * Remove ship
     *
     * @param \AppBundle\Entity\Ship $ship
     */
    public function removeShip(\AppBundle\Entity\Ship $ship)
    {
        $this->ships->removeElement($ship);
    }

    /**
     * Get ships
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShips()
    {
        return $this->ships;
    }

    /**
     * Add module
     *
     * @param \AppBundle\Entity\Module $module
     *
     * @return Universe
     */
    public function addModule(\AppBundle\Entity\Module $module)
    {
        $this->modules[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param \AppBundle\Entity\Module $module
     */
    public function removeModule(\AppBundle\Entity\Module $module)
    {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }
}
