<?php

namespace AppBundle\Controller;

/**
 * Interface BaseInterface
 * @package AppBundle\Controller
 */
interface BaseInterface
{
    /**
     * @return mixed
     */
    public function getManager();

    /**
     * @return mixed
     */
    public function getIndexView();

    /**
     * @return mixed
     */
    public function getView();

    /**
     * @return mixed
     */
    public function getViewForm();

    /**
     * @param mixed $entities
     *
     * @return array
     */
    public function getParametersRenderIndex($entities);

    /**
     * @param mixed $entity
     *
     * @return array
     */
    public function getParametersRenderView($entity);

    /**
     * @param mixed $manager
     *
     * @return array
     */
    public function getParametersRenderAdd($manager);

    /**
     * @return mixed
     */
    public function getInitClass();

    /**
     * @return mixed
     */
    public function getFormClass();

}