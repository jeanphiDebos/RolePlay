<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class Character
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 * @ORM\Table(name="user_character")
 */
class Character
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     * @Groups({"readInventory", "writeInventory", "readCraft"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=150, unique=true)
     * @Assert\NotBlank()
     * @Groups({"readInventory", "readCraft"})
     */
    private $username;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false, options={"default" : 1})
     * @Groups({"readInventory", "readCraft"})
     */
    private $lvl;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false, options={"default" : 1})
     * @Groups({"readInventory", "readCraft"})
     */
    private $resource;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="character")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $player;

    /**
     * @var ArrayCollection<Inventory>
     * @ORM\OneToMany(targetEntity="App\Entity\Inventory", mappedBy="character", cascade={"persist", "remove"})
     */
    private $inventories;

    /**
     * @var ArrayCollection<VisibilityCraftItem>
     * @ORM\OneToMany(targetEntity="App\Entity\VisibilityCraftItem", mappedBy="character", cascade={"persist", "remove"})
     */
    private $visibilityCraftItems;

    /**
     * Character constructor.
     */
    public function __construct()
    {
        $this->inventories = new ArrayCollection();
        $this->visibilityCraftItems = new ArrayCollection();
        $this->lvl = 1;
        $this->resource = 1;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    public function setLvl(string $lvl): self
    {
        $this->lvl = $lvl;

        return $this;
    }

    public function getResource(): ?int
    {
        return $this->resource;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPlayer(): ?User
    {
        return $this->player;
    }

    public function setPlayer(User $player): self
    {
        $this->player = $player;

        // set the owning side of the relation if necessary
        if ($this !== $player->getCharacter()) {
            $player->setCharacter($this);
        }

        return $this;
    }

    /**
     * Add inventory
     *
     * @param Inventory $inventory
     *
     * @return $this
     */
    public function addInventory(Inventory $inventory): self
    {
        $this->inventories->add($inventory);

        return $this;
    }

    /**
     * Remove inventory
     *
     * @param Inventory $inventory
     *
     * @return $this
     */
    public function removeInventory(Inventory $inventory): self
    {
        $this->inventories->removeElement($inventory);

        return $this;
    }

    /**
     * @return Collection|Inventory[]
     */
    public function getInventories(): Collection
    {
        return $this->inventories;
    }

    /**
     * @param Collection|Inventory[]
     */
    public function setInventories($inventories): self
    {
        $this->inventories = $inventories;

        return $this;
    }

    /**
     * Add visibilityCraftItems
     *
     * @param VisibilityCraftItem $visibilityCraftItem
     *
     * @return $this
     */
    public function addVisibilityCraftItem(VisibilityCraftItem $visibilityCraftItem): self
    {
        // $this->visibilityCraftItems->add($visibilityCraftItem);
        if (!$this->visibilityCraftItems->contains($visibilityCraftItem)) {
            $this->visibilityCraftItems[] = $visibilityCraftItem;
            $visibilityCraftItem->setCharacter($this);
        }

        return $this;
    }

    /**
     * Remove visibilityCraftItems
     *
     * @param VisibilityCraftItem $visibilityCraftItem
     *
     * @return $this
     */
    public function removeVisibilityCraftItem(VisibilityCraftItem $visibilityCraftItem): self
    {
        // $this->visibilityCraftItems->removeElement($visibilityCraftItem);
        if ($this->visibilityCraftItems->contains($visibilityCraftItem)) {
            $this->visibilityCraftItems->removeElement($visibilityCraftItem);
            // set the owning side to null (unless already changed)
            if ($visibilityCraftItem->getCharacter() === $this) {
                $visibilityCraftItem->setCharacter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VisibilityCraftItem[]
     */
    public function getVisibilityCraftItems(): Collection
    {
        return $this->visibilityCraftItems;
    }

    /**
     * @param Collection|VisibilityCraftItem[]
     */
    public function setVisibilityCraftItems(Collection $visibilityCraftItems): self
    {
        $this->visibilityCraftItems = $visibilityCraftItems;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->username;
    }
}