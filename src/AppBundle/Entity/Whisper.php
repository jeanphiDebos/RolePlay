<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Whisper
 * @ORM\Entity()
 * @ORM\Table(name="whisper")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Whisper
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
     * @ORM\Column(name="whisp", type="string", length=255, nullable=false)
     */
    protected $whisp;
    /**
     * @var boolean
     * @ORM\Column(name="read", type="boolean", nullable=false)
     */
    protected $read;
    /**
     * @var \DateTime
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    protected $dateTime;
    /**
     * @var Character
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Character", inversedBy="whispers")
     */
    protected $character;

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
     * Get whisp
     *
     * @return string
     */
    public function getWhisp()
    {
        return $this->whisp;
    }

    /**
     * Set whisp
     *
     * @param string $whisp
     *
     * @return Whisper
     */
    public function setWhisp($whisp)
    {
        $this->whisp = $whisp;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set read
     *
     * @param boolean $read
     *
     * @return Whisper
     */
    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     *
     * @return Whisper
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get character
     *
     * @return \AppBundle\Entity\Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set character
     *
     * @param \AppBundle\Entity\Character $character
     *
     * @return Whisper
     */
    public function setCharacter(\AppBundle\Entity\Character $character = null)
    {
        $this->character = $character;

        return $this;
    }
}
