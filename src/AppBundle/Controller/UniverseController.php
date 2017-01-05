<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Universe;
use AppBundle\Form\UniverseType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class UniverseController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(Universe::class);
    }

    /**
     * @Route("/universe/", name="appbundle_universe_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/universe/view/{id}", name="appbundle_universe_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/universe/add", name="appbundle_universe_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/universe/edit/{id}", name="appbundle_universe_edit", requirements={
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
     * @Route("/universe/remove/{id}", name="appbundle_universe_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/universe/list-universe.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'universe';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return UniverseType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Universe();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/universe/view-universe.html.twig';
    }
}