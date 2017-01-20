<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DisplayType;
use AppBundle\Form\DisplayTypeType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DisplayTypeController
 * @package AppBundle\Controller\DisplayTypeController
 * @Route(path="/admin")
 */
class DisplayTypeController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(DisplayType::class);
    }

    /**
     * @Route("/display_type/", name="appbundle_display_type_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/display_type/view/{id}", name="appbundle_display_type_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/display_type/add", name="appbundle_display_type_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/display_type/edit/{id}", name="appbundle_display_type_edit", requirements={
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
     * @Route("/display_type/remove/{id}", name="appbundle_display_type_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/map/list-display-type.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'display_type';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return DisplayTypeType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new DisplayType();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/map/view-display-type.html.twig';
    }
}