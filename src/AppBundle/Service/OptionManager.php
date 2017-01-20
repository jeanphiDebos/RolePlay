<?php
namespace AppBundle\Service;

use AppBundle\Entity\Option;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
 * Class CharacterManager
 * @package AppBundle\Service
 */
class OptionManager extends DefaultManager
{
    /**
     * @var Option
     */
    protected $entity;
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;
    /**
     * @var array
     */
    protected $defautOption;

    /**
     * CharacterManager constructor.
     * @param EntityManager $em
     * @param String $targetPicture
     */
    public function __construct(EntityManager $em, $targetPicture)
    {
        $this->defautOption = array('damageCanonShell' => 1, 'damageCanonCrew' => 0.25, 'damageCanonCanon' => 0.1, 'damageCrewCrew' => 0.25);
        parent::__construct($em, $targetPicture);
    }

    /**
     * @param string $shortname
     * @return Option
     */
    public function selectOption($shortname){
        $option = $this->repository->findOneBy(array('shortName' => $shortname));

        if ($option == NULL){
            $option = new Option();
            $option->setShortName($shortname);
            $option->setName($shortname);
            $option->setValue("");
            if (isset($this->defautOption[$shortname])) $option->setValue($this->defautOption[$shortname]);
            $this->save($option);
        }

        return $option;
    }
}