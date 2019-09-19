<?php
/**
 * Created by PhpStorm.
 * User: jdebos
 * Date: 07/12/2017
 * Time: 13:49
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Inventory
 * @package App\Entity
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"readInventory"}},
 *     "denormalization_context"={"api_allow_update"=true, "groups"={"writeInventory"}}
 * })
 * @ApiFilter(SearchFilter::class, properties={"character.id": "exact", "character.id": "exact"})
 * @ORM\Entity
 * @ORM\Table(name="inventory")
 */
class Inventory
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"readInventory"})
     */
    protected $id;
    /**
     * @var Character
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="inventories")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id", nullable=false)
     * @Groups({"readInventory", "writeInventory"})
     */
    protected $character;
    /**
     * @var Item
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="inventories")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id", nullable=false)
     * @Groups({"readInventory", "writeInventory"})
     */
    protected $item;

    /**
     * Inventory constructor.
     */
    public function __construct()
    {

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
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item)
    {
        $this->item = $item;
    }
}