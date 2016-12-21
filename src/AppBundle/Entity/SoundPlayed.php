<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SoundPlayed
 * @ORM\Entity()
 * @ORM\Table(name="sound_played")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SoundPlayed
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id_session", type="integer")
     */
    protected $session;
    /**
     * @var SoundsToPlay
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SoundsToPlay", inversedBy="soundPlayeds")
     */
    protected $soundsToPlay;

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
     * Get session
     *
     * @return integer
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set session
     *
     * @param integer $session
     *
     * @return SoundPlayed
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get soundsToPlay
     *
     * @return \AppBundle\Entity\SoundsToPlay
     */
    public function getSoundsToPlay()
    {
        return $this->soundsToPlay;
    }

    /**
     * Set soundsToPlay
     *
     * @param \AppBundle\Entity\SoundsToPlay $soundsToPlay
     *
     * @return SoundPlayed
     */
    public function setSoundsToPlay(\AppBundle\Entity\SoundsToPlay $soundsToPlay)
    {
        $this->soundsToPlay = $soundsToPlay;

        return $this;
    }
}
