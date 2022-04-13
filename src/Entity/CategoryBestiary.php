<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CategoryBestiary
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity()
 * @ORM\Table(name="category_bestiary")
 */
class CategoryBestiary extends Taxonomy
{
    /**
     * @var ArrayCollection<TypeBestiary>
     * @ORM\OneToMany(targetEntity="App\Entity\TypeBestiary", mappedBy="categoryBestiary")
     */
    protected $typeBestiary;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"readPathfinderBestiary"})
     */
    protected $textColor;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"readPathfinderBestiary"})
     */
    protected $backgroundColor;

    /**
     * CategoryBestiary constructor.
     */
    public function __construct()
    {
        $this->typeBestiary = new ArrayCollection();
    }

    /**
     * Add typeBestiary
     *
     * @param TypeBestiary $typeBestiary
     *
     * @return $this
     */
    public function addTypeBestiary(TypeBestiary $typeBestiary)
    {
        $this->typeBestiary->add($typeBestiary);

        return $this;
    }

    /**
     * Remove typeBestiary
     *
     * @param TypeBestiary $typeBestiary
     */
    public function removeTypeBestiary(TypeBestiary $typeBestiary)
    {
        $this->typeBestiary->removeElement($typeBestiary);
    }

    /**
     * @return ArrayCollection
     */
    public function getTypeBestiary()
    {
        return $this->typeBestiary;
    }

    /**
     * @param ArrayCollection $typeBestiary
     */
    public function setTypeBestiary(ArrayCollection $typeBestiary)
    {
        $this->typeBestiary = $typeBestiary;
    }

    /**
     * @return string
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param string $textColor
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
    }
}
