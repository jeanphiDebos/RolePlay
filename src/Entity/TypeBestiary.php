<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TypeBestiary
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity()
 * @ORM\Table(name="type_bestiary")
 */
class TypeBestiary extends Taxonomy
{
    /**
     * @var ArrayCollection<PathfinderBestiary>
     * @ORM\ManyToMany(targetEntity="App\Entity\PathfinderBestiary", mappedBy="typeBestiarys", cascade={"persist"})
     */
    protected $pathfinderBestiarys;

    /**
     * @var CategoryBestiary
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryBestiary", inversedBy="typeBestiary")
     * @Groups({"readPathfinderBestiary"})
     */
    protected $categoryBestiary;

    /**
     * TypeBestiary constructor.
     */
    public function __construct()
    {
        $this->pathfinderBestiarys = new ArrayCollection();
    }

    /**
     * Add pathfinderBestiary
     *
     * @param IPathfinderBestiarytem $pathfinderBestiary
     *
     * @return $this
     */
    public function addPathfinderBestiary(PathfinderBestiary $pathfinderBestiary)
    {
        $this->pathfinderBestiarys->add($pathfinderBestiary);

        return $this;
    }

    /**
     * Remove pathfinderBestiary
     *
     * @param PathfinderBestiary $pathfinderBestiary
     */
    public function removePathfinderBestiary(PathfinderBestiary $pathfinderBestiary)
    {
        $this->pathfinderBestiarys->removeElement($pathfinderBestiary);
    }

    /**
     * @return ArrayCollection
     */
    public function getPathfinderBestiarys()
    {
        return $this->pathfinderBestiarys;
    }

    /**
     * @param ArrayCollection $pathfinderBestiarys
     */
    public function setPathfinderBestiarys(ArrayCollection $pathfinderBestiarys)
    {
        $this->pathfinderBestiarys = $pathfinderBestiarys;
    }

    /**
     * @return CategoryBestiary
     */
    public function getCategoryBestiary()
    {
        return $this->categoryBestiary;
    }

    /**
     * @param CategoryBestiary $categoryBestiary
     */
    public function setCategoryBestiary(CategoryBestiary $categoryBestiary)
    {
        $this->categoryBestiary = $categoryBestiary;
    }
}