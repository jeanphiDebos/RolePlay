<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DisplayType
 * @ORM\Entity()
 * @ORM\Table(name="display_type")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class DisplayType extends Status
{
    /**
     * @var Map[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Map", mappedBy="displayType")
     */
    protected $maps;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->maps = new ArrayCollection();
    }

    /**
     * Add map
     *
     * @param \AppBundle\Entity\Map $map
     *
     * @return DisplayType
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
}
