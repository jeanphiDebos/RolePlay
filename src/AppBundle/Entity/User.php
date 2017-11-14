<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Logs\LastSearchUser;
use AppBundle\Entity\Taxonomy\Domain;
use AppBundle\Entity\Taxonomy\RegionalDirectorate;
use AppBundle\Entity\Traits\BlameableEntity;
use AppBundle\Entity\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="enedis_user")
 */
class User extends BaseUser
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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array(static::ROLE_SUPER_ADMIN, $this->roles);
    }

    /**
     * @param bool $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        if ($isAdmin) {
        	if (!$this->isAdmin()) {
		        $this->roles[] = static::ROLE_SUPER_ADMIN;
	        }
        } else {
        	$roles = array_flip($this->roles);
        	unset($roles[static::ROLE_SUPER_ADMIN]);
        	$this->roles = array_flip($roles);
        }
    }
}