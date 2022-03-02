<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PathfinderBestiaryRepository")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"readPathfinderBestiary"}},
 *     "denormalization_context"={"api_allow_update"=true, "groups"={"writePathfinderBestiary"}}
 * })
 */
class PathfinderBestiary
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     * @Groups({"readPathfinderBestiary", "writePathfinderBestiary"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"readPathfinderBestiary"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"readPathfinderBestiary"})
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"readPathfinderBestiary"})
     */
    private $lifePoint;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"readPathfinderBestiary"})
     */
    private $initiation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"readPathfinderBestiary"})
     */
    private $info;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Groups({"readPathfinderBestiary"})
     */
    private $sheet;

    /**
     * @var File
     */
    private $imageFile;

    /**
     * @var ArrayCollection<TypeBestiary>
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeBestiary", inversedBy="pathfinderBestiary", cascade={"persist"})
     * @ORM\JoinTable(
     *      name="pathfinder_bestiars_type",
     *      joinColumns={@ORM\JoinColumn(name="pathfinder_bestiary_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="type_bestiary_id", referencedColumnName="id")}
     * )
     * @Groups({"readPathfinderBestiary"})
     */
    private $typeBestiarys;

    public function __construct()
    {
        $this->level = 0;
        $this->lifePoint = 0;
        $this->initiation = 0;
        $this->typeBestiarys = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLifePoint(): ?string
    {
        return $this->lifePoint;
    }

    public function setLifePoint(string $lifePoint): self
    {
        $this->lifePoint = $lifePoint;

        return $this;
    }

    public function getInitiation(): ?string
    {
        return $this->initiation;
    }

    public function setInitiation(string $initiation): self
    {
        $this->initiation = $initiation;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return string
     */
    public function getSheet()
    {
        return $this->sheet;
    }

    /**
     * @param string $sheet
     */
    public function setSheet($sheet)
    {
        $this->sheet = $sheet;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->sheet;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->sheet = $image;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
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
        $this->typeBestiarys->add($typeBestiary);

        return $this;
    }

    /**
     * Remove typeBestiary
     *
     * @param TypeBestiary $typeBestiary
     */
    public function removeTypeBestiary(TypeBestiary $typeBestiary)
    {
        $this->typeBestiarys->removeElement($typeBestiary);
    }

    /**
     * @return ArrayCollection
     */
    public function getTypeBestiarys()
    {
        return $this->typeBestiarys;
    }

    /**
     * @param ArrayCollection $typeBestiarys
     */
    public function setTypeBestiarys(ArrayCollection $typeBestiarys)
    {
        $this->typeBestiarys = $typeBestiarys;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->name;
    }
}
