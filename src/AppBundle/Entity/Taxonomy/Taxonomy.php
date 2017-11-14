<?php
/**
 * Created by PhpStorm.
 * User: jdebos
 * Date: 11/09/2017
 * Time: 16:59
 */

namespace AppBundle\Entity\Taxonomy;

use AppBundle\Entity\Traits\BlameableEntity;
use AppBundle\Entity\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Taxonomy
 * @package AppBundle\Entity\Taxonomy
 */
abstract class Taxonomy
{
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * Hook blameable behavior
     * updates createdBy, updatedBy fields
     */
    use BlameableEntity;

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Type("string")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @JMS\Type("string")
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(name="shortname", type="string", length=255, nullable=false)
     * @JMS\Type("string")
     */
    protected $shortName;

    /**
     * Taxonomy constructor.
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