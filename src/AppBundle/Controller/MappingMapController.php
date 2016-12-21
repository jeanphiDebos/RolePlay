<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MappingMap;
use AppBundle\Form\MappingMapType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MappingMapController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(MappingMap::class);
    }

    /**
     * @Route("/mapping_map/", name="appbundle_mapping_map_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/mapping_map/view/{id}", name="appbundle_mapping_map_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/mapping_map/add", name="appbundle_mapping_map_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/mapping_map/edit/{id}", name="appbundle_mapping_map_edit", requirements={
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
     * @Route("/mapping_map/remove/{id}", name="appbundle_mapping_map_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/map/list-mapping-map.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'mapping_map';
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return '@' . $this->getThemeAdmin() . '/map/form-mapping-map.html.twig';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return MappingMapType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new MappingMap();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/map/view-mapping-map.html.twig';
    }
}