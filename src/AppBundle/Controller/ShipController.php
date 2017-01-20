<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ship;
use AppBundle\Form\ShipType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ShipController
 * @package AppBundle\Controller\ShipController
 * @Route(path="/admin")
 */
class ShipController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(Ship::class);
    }

    /**
     * @Route("/ship/", name="appbundle_ship_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/ship/view/{id}", name="appbundle_ship_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/ship/add", name="appbundle_ship_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/ship/edit/{id}", name="appbundle_ship_edit", requirements={
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
     * @Route("/ship/remove/{id}", name="appbundle_ship_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/ship/list-ship.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'ship';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return ShipType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Ship();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/ship/view-ship.html.twig';
    }
}