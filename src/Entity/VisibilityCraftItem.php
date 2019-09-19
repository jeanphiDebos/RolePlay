<?php
/**
 * Created by PhpStorm.
 * User: jdebos
 * Date: 07/12/2017
 * Time: 13:49
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class VisibilityItem
 * @package App\Entity
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"readVisibilityCraftItem"}},
 *     "denormalization_context"={"groups"={"writeVisibilityCraftItem"}}
 * })
 * @ORM\Entity
 * @ORM\Table(name="visibility_craft_item",
 *    uniqueConstraints={
 *        @UniqueConstraint(
 *          name="visibility_craft_item_unique",
 *          columns={"character_id", "craft_id"}
 *        )
 *    })
 */
class VisibilityCraftItem
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"readCraft", "readVisibilityCraftItem"})
     */
    protected $id;
    /**
     * @var Character
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="visibilityCraftItems")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id", nullable=false)
     * @Groups({"readCraft", "readVisibilityCraftItem", "writeVisibilityCraftItem"})
     */
    protected $character;
    /**
     * @var Craft
     * @ORM\ManyToOne(targetEntity="App\Entity\Craft", inversedBy="visibilityCraftItems")
     * @ORM\JoinColumn(name="craft_id", referencedColumnName="id", nullable=false)
     * @Groups({"readVisibilityCraftItem", "writeVisibilityCraftItem", "writeVisibilityCraftItem"})
     */
    protected $craft;
    /**
     * @var boolean
     * @ORM\Column(name="isvalid", type="boolean", options={"default":true})
     * @Groups({"readCraft", "readVisibilityCraftItem"})
     */
    protected $isValid;

    /**
     * Inventory constructor.
     */
    public function __construct()
    {
        $this->isValid = true;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param Character $character
     */
    public function setCharacter(Character $character)
    {
        $this->character = $character;
    }

    /**
     * @return Craft
     */
    public function getCraft()
    {
        return $this->craft;
    }

    /**
     * @param Craft $craft
     */
    public function setCraft(Craft $craft)
    {
        $this->craft = $craft;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     */
    public function setIsValid(bool $isValid)
    {
        $this->isValid = $isValid;
    }
}