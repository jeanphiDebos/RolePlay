<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class SoundsToPlay
 * @ORM\Entity()
 * @ORM\Table(name="sounds_to_play")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SoundsToPlay
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var \DateTime
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    protected $dateTime;
    /**
     * @var \DateTime
     * @ORM\Column(name="path_Sound", type="string", length=255, nullable=false)
     */
    protected $pathSound;
    /**
     * @var Character
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Character", inversedBy="soundsToPlays")
     */
    protected $character;
    /**
     * @var SoundPlayed[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SoundsToPlay", mappedBy="soundsToPlay")
     */
    protected $soundPlayeds;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->soundPlayeds = new ArrayCollection();
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
     * @return SoundsToPlay
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get pathSound
     *
     * @return string
     */
    public function getPathSound()
    {
        return $this->pathSound;
    }

    /**
     * Set pathSound
     *
     * @param string $pathSound
     *
     * @return SoundsToPlay
     */
    public function setPathSound($pathSound)
    {
        $this->pathSound = $pathSound;

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
     * @return SoundsToPlay
     */
    public function setCharacter(\AppBundle\Entity\Character $character = null)
    {
        $this->character = $character;

        return $this;
    }

    /**
     * Add soundPlayed
     *
     * @param \AppBundle\Entity\SoundsToPlay $soundPlayed
     *
     * @return SoundsToPlay
     */
    public function addSoundPlayed(\AppBundle\Entity\SoundsToPlay $soundPlayed)
    {
        $this->soundPlayeds[] = $soundPlayed;

        return $this;
    }

    /**
     * Remove soundPlayed
     *
     * @param \AppBundle\Entity\SoundsToPlay $soundPlayed
     */
    public function removeSoundPlayed(\AppBundle\Entity\SoundsToPlay $soundPlayed)
    {
        $this->soundPlayeds->removeElement($soundPlayed);
    }

    /**
     * Get soundPlayeds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoundPlayeds()
    {
        return $this->soundPlayeds;
    }
}
