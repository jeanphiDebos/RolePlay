<?php
namespace AppBundle\Service;

use AppBundle\Entity\Character;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
 * Class CharacterManager
 * @package AppBundle\Service
 */
class CharacterManager extends DefaultManager
{
    /**
     * @var Character
     */
    protected $entity;
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * CharacterManager constructor.
     * @param EntityManager $em
     * @param String $targetPicture
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManager $em, $targetPicture, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($em, $targetPicture);
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return bool
     */
    public function gestionOptions()
    {
        $this->save($this->entity);

        $encoder = new BCryptPasswordEncoder(12);
        $encoded = $encoder->encodePassword($this->entity->getPassword(), $this->entity->getSalt());
        $this->entity->setPassword($encoded);

        /** @var Character $entity */
        $entity = $this->save($this->entity);

        if ($this->entity->getId()) {
            $this->session->getFlashBag()->add('success', 'Character.message.success_edit');
        } else {
            $this->session->getFlashBag()->add('success', 'Character.message.success_add');
        }
        return true;
    }
}