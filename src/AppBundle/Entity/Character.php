<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Character
 * @ORM\Entity()
 * @ORM\Table(name="character")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Character
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
     * @var FieldCharacter[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FieldCharacter", mappedBy="character")
     */
    protected $fieldCharacters;
    /**
     * @var SoundsToPlay[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SoundsToPlay", mappedBy="character")
     */
    protected $soundsToPlays;
    /**
     * @var Whisper[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Whisper", mappedBy="character")
     */
    protected $whispers;
    /**
     * @var Universe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universe", inversedBy="character")
     */
    protected $universe;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->fieldCharacters = new ArrayCollection();
        $this->soundsToPlays = new ArrayCollection();
        $this->whispers = new ArrayCollection();
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
     * @return Character
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add fieldCharacter
     *
     * @param \AppBundle\Entity\FieldCharacter $fieldCharacter
     *
     * @return Character
     */
    public function addFieldCharacter(\AppBundle\Entity\FieldCharacter $fieldCharacter)
    {
        $this->fieldCharacters[] = $fieldCharacter;

        return $this;
    }

    /**
     * Remove fieldCharacter
     *
     * @param \AppBundle\Entity\FieldCharacter $fieldCharacter
     */
    public function removeFieldCharacter(\AppBundle\Entity\FieldCharacter $fieldCharacter)
    {
        $this->fieldCharacters->removeElement($fieldCharacter);
    }

    /**
     * Get fieldCharacters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFieldCharacters()
    {
        return $this->fieldCharacters;
    }

    /**
     * Add soundsToPlay
     *
     * @param \AppBundle\Entity\SoundsToPlay $soundsToPlay
     *
     * @return Character
     */
    public function addSoundsToPlay(\AppBundle\Entity\SoundsToPlay $soundsToPlay)
    {
        $this->soundsToPlays[] = $soundsToPlay;

        return $this;
    }

    /**
     * Remove soundsToPlay
     *
     * @param \AppBundle\Entity\SoundsToPlay $soundsToPlay
     */
    public function removeSoundsToPlay(\AppBundle\Entity\SoundsToPlay $soundsToPlay)
    {
        $this->soundsToPlays->removeElement($soundsToPlay);
    }

    /**
     * Get soundsToPlays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoundsToPlays()
    {
        return $this->soundsToPlays;
    }

    /**
     * Add whisper
     *
     * @param \AppBundle\Entity\Whisper $whisper
     *
     * @return Character
     */
    public function addWhisper(\AppBundle\Entity\Whisper $whisper)
    {
        $this->whispers[] = $whisper;

        return $this;
    }

    /**
     * Remove whisper
     *
     * @param \AppBundle\Entity\Whisper $whisper
     */
    public function removeWhisper(\AppBundle\Entity\Whisper $whisper)
    {
        $this->whispers->removeElement($whisper);
    }

    /**
     * Get whispers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWhispers()
    {
        return $this->whispers;
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
     * @return Character
     */
    public function setUniverse(\AppBundle\Entity\Universe $universe = null)
    {
        $this->universe = $universe;

        return $this;
    }
}
