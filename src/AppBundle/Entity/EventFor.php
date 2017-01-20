<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class EventFor
 * @ORM\Entity()
 * @ORM\Table(name="event_for")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 * @Serializer\ExclusionPolicy("none")
 */
class EventFor extends Status
{
    /**
     * @var Event[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Event", mappedBy="for")
     * @Serializer\MaxDepth(0)
     */
    protected $events;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return EventFor
     */
    public function addEvent(\AppBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \AppBundle\Entity\Event $event
     */
    public function removeEvent(\AppBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
