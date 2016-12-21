<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShipType
 * @ORM\Entity()
 * @ORM\Table(name="ship_type")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ShipType extends Status
{
    /**
     * @var Ship[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ship", mappedBy="type")
     */
    protected $ships;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ships = new ArrayCollection();
    }

    /**
     * Add ship
     *
     * @param Ship $ship
     *
     * @return ShipType
     */
    public function addProject(Ship $ship)
    {
        $this->ships[] = $ship;

        return $this;
    }

    /**
     * Remove ship
     *
     * @param Ship $ship
     */
    public function removeProject(Ship $ship)
    {
        $this->ships->removeElement($ship);
    }

    /**
     * Get ships
     *
     * @return Collection
     */
    public function getProjects()
    {
        return $this->ships;
    }

    /**
     * Add ship
     *
     * @param \AppBundle\Entity\Ship $ship
     *
     * @return ShipType
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
}
