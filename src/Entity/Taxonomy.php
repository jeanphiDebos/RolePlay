<?php
/**
 * Created by PhpStorm.
 * User: jdebos
 * Date: 11/09/2017
 * Time: 16:59
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Taxonomy
 * @package App\Entity
 * @ORM\MappedSuperclass
 */
abstract class Taxonomy
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"readInventory", "readCraft", "readPathfinderBestiary"})
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(name="shortname", type="string", length=255, nullable=false)
     */
    protected $shortName;

    /**
     * Taxonomy constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name      = $name;
        $this->shortName = preg_replace(
            ['/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'],
            '_',
            iconv(
                'UTF-8',
                'ASCII//TRANSLIT//IGNORE',
                $name
            )
        );
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
    }
}