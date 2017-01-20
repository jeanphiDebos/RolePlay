<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ConfigurationFieldFor;
use AppBundle\Form\ConfigurationFieldForForType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfigurationFieldForController
 * @package AppBundle\Controller\ConfigurationFieldForController
 * @Route(path="/admin")
 */
class ConfigurationFieldForController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(ConfigurationFieldFor::class);
    }

    /**
     * @Route("/configuration_field_for/", name="appbundle_configuration_field_for_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/configuration_field_for/view/{id}", name="appbundle_configuration_field_for_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/configuration_field_for/add", name="appbundle_configuration_field_for_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/configuration_field_for/edit/{id}", name="appbundle_configuration_field_for_edit", requirements={
     *     "id": "\d+"
     * })
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        return parent::editAction($request, $id);
    }

    /**
     * @Route("/configuration_field_for/remove/{id}", name="appbundle_configuration_field_for_remove", requirements={
     *     "id": "\d+"
     * })
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction($id)
    {
        return parent::removeAction($id);
    }

    /**
     * @return mixed
     */
    public function getIndexView()
    {
        return '@' . $this->getThemeAdmin() . '/configurationField/list-configuration-field-for.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'configuration_field_for';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return ConfigurationFieldForForType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new ConfigurationFieldFor();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/configurationField/view-configuration-field-for.html.twig';
    }
}