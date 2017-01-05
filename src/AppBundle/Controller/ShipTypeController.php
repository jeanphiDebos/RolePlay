<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ShipType;
use AppBundle\Form\ShipTypeType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ShipTypeController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(ShipType::class);
    }

    /**
     * @Route("/ship_type/", name="appbundle_ship_type_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/ship_type/view/{id}", name="appbundle_ship_type_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/ship/add", name="appbundle_ship_type_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/ship_type/edit/{id}", name="appbundle_ship_type_edit", requirements={
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
     * @Route("/ship_type/remove/{id}", name="appbundle_ship_type_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/ship/list-ship-type.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'ship_type';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return ShipTypeType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new ShipType();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/ship/view-ship-type.html.twig';
    }
}