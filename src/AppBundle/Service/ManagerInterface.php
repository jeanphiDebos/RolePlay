<?php

namespace AppBundle\Service;

/**
 * @author Melina Sikounnavong <melina.sik@gmail.com>
 */
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface ManagerInterface
 * @package AppBundle\Service
 */
interface ManagerInterface
{

    /**
     * @param $id
     * @return mixed
     */
    public function getEntity($id);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     *
     */
    public function gestionOptions();

    /**
     * @param $entity
     * @return Entity
     */
    public function save($entity);

    /**
     * @param $entity
     */
    public function remove($entity);

    /**
     * @param Form $form
     * @param Request $request
     * @return ManagerInterface
     */
    public function setForm(Form $form, Request $request);

    /**
     * @return Form
     */
    public function getForm();

    /**
     * @param array $options
     * @return boolean
     */
    public function process(array $options = array());

    /**
     * @return boolean
     */
    public function success();

}