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
     * @param $entity
     * @return mixed
     */
    public function getNameForView($entity);

    /**
     * @return mixed
     */
    public function getViewForm();

    /**
     * @return mixed
     */
    public function getFormClass();

    /**
     * @return mixed
     */
    public function getInitClass();

}