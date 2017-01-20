<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Map;
use AppBundle\Form\MapType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MapController
 * @package AppBundle\Controller\MapController
 * @Route(path="/admin")
 */
class MapController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(Map::class);
    }

    /**
     * @Route("/map/", name="appbundle_map_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/map/view/{id}", name="appbundle_map_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/map/add", name="appbundle_map_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/map/edit/{id}", name="appbundle_map_edit", requirements={
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
     * @Route("/map/remove/{id}", name="appbundle_map_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/map/list-map.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'map';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return MapType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Map();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/map/view-map.html.twig';
    }
}