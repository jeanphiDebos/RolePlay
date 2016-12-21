<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Module
 * @ORM\Entity()
 * @ORM\Table(name="module")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Module
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
     * @var Universe[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Universe", inversedBy="modules")
     * @ORM\JoinTable(name="active_module",
     *      joinColumns={@ORM\JoinColumn(name="module_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="universe_id", referencedColumnName="id")}
     * )
     */
    protected $universes;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->universes = new ArrayCollection();
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
     * @return Module
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add universe
     *
     * @param \AppBundle\Entity\Universe $universe
     *
     * @return Module
     */
    public function addUniverse(\AppBundle\Entity\Universe $universe)
    {
        $this->universes[] = $universe;

        return $this;
    }

    /**
     * Remove universe
     *
     * @param \AppBundle\Entity\Universe $universe
     */
    public function removeUniverse(\AppBundle\Entity\Universe $universe)
    {
        $this->universes->removeElement($universe);
    }

    /**
     * Get universes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUniverses()
    {
        return $this->universes;
    }
}
