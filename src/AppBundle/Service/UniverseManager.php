<?php
namespace AppBundle\Service;

use AppBundle\Entity\Module;
use AppBundle\Entity\Universe;
use Doctrine\ORM\EntityManager;

/**
 * Class UniverseManager
 * @package AppBundle\Service\Universe
 */
class UniverseManager extends DefaultManager
{
    /**
     * @var Universe
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
        if (!empty($this->options['module'])) {
            /** @var Module $module */
            foreach ($this->options['module'] as $module) {
                if ($this->entity->getModules()->contains($module) == false) {
                    $this->entity->getModules()->removeElement($module);
                    $module->removeUniverse($this->entity);
                    $this->save($module);
                }
            }
            $this->save($this->entity);
        }
        foreach ($this->entity->getModules() as $module) {
            if ($module->getUniverses()->contains($this->entity) == false) {
                $this->entity->addModule($module);
                $module->addUniverse($this->entity);
                $this->save($module);
            }
        }
        $this->save($this->entity);
    }
}