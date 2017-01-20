<?php
namespace AppBundle\Service;

use AppBundle\Entity\Module;
use AppBundle\Entity\Universe;
use Doctrine\ORM\EntityManager;

/**
 * Class ModuleManager
 * @package AppBundle\Service\Module
 */
class ModuleManager extends DefaultManager
{
    /**
     * @var Module
     */
    protected $entity;

    /**
     * ActivityManager constructor.
     * @param EntityManager $em
     * @param String $targetPicture
     */
    public function __construct(EntityManager $em, $targetPicture)
    {
        parent::__construct($em, $targetPicture);
    }

    /**
     *
     */
    public function gestionOptions()
    {
        if (!empty($this->options['universe'])) {
            /** @var Universe $universe */
            foreach ($this->options['universe'] as $universe) {
                if ($this->entity->getUniverses()->contains($universe) == false) {
                    $this->entity->getUniverses()->removeElement($universe);
                    $universe->removeModule($this->entity);
                    $this->save($universe);
                }
            }
            $this->save($this->entity);
        }
        foreach ($this->entity->getUniverses() as $universe) {
            if ($universe->getModules()->contains($this->entity) == false) {
                $this->entity->addUniverse($universe);
                $universe->addModule($this->entity);
                $this->save($universe);
            }
        }
        $this->save($this->entity);
    }
}