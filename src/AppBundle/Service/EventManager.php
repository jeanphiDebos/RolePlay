<?php
namespace AppBundle\Service;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventAnimation;
use AppBundle\Entity\EventFor;
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
class EventManager extends DefaultManager
{
    /**
     * @var Event
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
     */
    public function __construct(EntityManager $em, $targetPicture)
    {
        parent::__construct($em, $targetPicture);
    }

    /**
     * @param String $valeur
     * @param String $animation
     * @param String $for
     * @return Entity
     */
    public function addNewEvent($valeur, $animation, $for)
    {
        $event = new Event();

        $entityAnimation = $this->em->getRepository(EventAnimation::class)->findOneBy(array('shortName' => $animation));
        $entityFor = $this->em->getRepository(EventFor::class)->findOneBy(array('shortName' => $for));

        if ($entityAnimation == NULL){
            $entityAnimation = new EventAnimation();
            $entityAnimation->setShortName($animation);
            $entityAnimation->setName($animation);
        }
        if ($entityFor == NULL){
            $entityFor = new EventFor();
            $entityFor->setShortName($for);
            $entityFor->setName($for);
        }

        $event->setValue($valeur)->setDateTime(new \DateTime())->setPlay(false)->setAnimation($entityAnimation)->setFor($entityFor);
        return $this->save($event);
    }
}