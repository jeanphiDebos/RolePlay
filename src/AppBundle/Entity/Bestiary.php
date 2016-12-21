<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Bestiary
 * @ORM\Entity()
 * @ORM\Table(name="bestiary")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Bestiary
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
     * @ORM\Column(name="hide", type="boolean", nullable=false)
     */
    protected $hide;
    /**
     * @var FieldBestiary[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FieldBestiary", mappedBy="bestiary")
     */
    protected $fieldBestiarys;
    /**
     * @var Universe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universe", inversedBy="bestiary")
     */
    protected $universe;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->fieldBestiarys = new ArrayCollection();
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
     * @return Bestiary
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get hide
     *
     * @return boolean
     */
    public function getHide()
    {
        return $this->hide;
    }

    /**
     * Set hide
     *
     * @param boolean $hide
     *
     * @return Bestiary
     */
    public function setHide($hide)
    {
        $this->hide = $hide;

        return $this;
    }

    /**
     * Add fieldBestiary
     *
     * @param \AppBundle\Entity\FieldBestiary $fieldBestiary
     *
     * @return Bestiary
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
     * @return Bestiary
     */
    public function setUniverse(\AppBundle\Entity\Universe $universe = null)
    {
        $this->universe = $universe;

        return $this;
    }
}
