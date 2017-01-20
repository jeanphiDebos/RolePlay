<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ConfigurationField;
use AppBundle\Form\ConfigurationFieldType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfigurationFieldController
 * @package AppBundle\Controller\ConfigurationFieldController
 * @Route(path="/admin")
 */
class ConfigurationFieldController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(ConfigurationField::class);
    }

    /**
     * @Route("/configuration_field/", name="appbundle_configuration_field_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/configuration_field/view/{id}", name="appbundle_configuration_field_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/configuration_field/add", name="appbundle_configuration_field_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/configuration_field/edit/{id}", name="appbundle_configuration_field_edit", requirements={
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
     * @Route("/configuration_field/remove/{id}", name="appbundle_configuration_field_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/configurationField/list-configuration-field.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'configuration_field';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return ConfigurationFieldType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new ConfigurationField();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/configurationField/view-configuration-field.html.twig';
    }
}