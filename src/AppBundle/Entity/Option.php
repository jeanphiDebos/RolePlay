<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Option
 * @ORM\Entity()
 * @ORM\Table(name="option_role_play")
 * @package AppBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Option extends Status
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
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    protected $value;

    /**
     * constructor.
     */
    public function __construct()
    {

    }

    /**
     *
     */
    public function __destruct()
    {

    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Option
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
