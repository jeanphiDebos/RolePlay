<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ConfigurationFieldType;
use AppBundle\Form\ConfigurationFieldTypeType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ConfigurationFieldTypeController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(ConfigurationFieldType::class);
    }

    /**
     * @Route("/configuration_field_type/", name="appbundle_configuration_field_type_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/configuration_field_type/view/{id}", name="appbundle_configuration_field_type_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/configuration_field_type/add", name="appbundle_configuration_field_type_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/configuration_field_type/edit/{id}", name="appbundle_configuration_field_type_edit", requirements={
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
     * @Route("/configuration_field_type/remove/{id}", name="appbundle_configuration_field_type_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/configurationField/list-configuration-field-type.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'configuration_field_type';
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return '@' . $this->getThemeAdmin() . '/configurationField/form-configuration-field-type.html.twig';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return ConfigurationFieldTypeType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new ConfigurationFieldType();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/configurationField/view-configuration-field-type.html.twig';
    }
}