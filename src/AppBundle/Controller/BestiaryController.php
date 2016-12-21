<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bestiary;
use AppBundle\Form\BestiaryType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class BestiaryController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(Bestiary::class);
    }

    /**
     * @Route("/bestiary/", name="appbundle_bestiary_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/bestiary/view/{id}", name="appbundle_bestiary_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/bestiary/add", name="appbundle_bestiary_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/bestiary/edit/{id}", name="appbundle_bestiary_edit", requirements={
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
     * @Route("/bestiary/remove/{id}", name="appbundle_bestiary_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/bestiary/list-bestiary.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'bestiary';
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return '@' . $this->getThemeAdmin() . '/bestiary/form-bestiary.html.twig';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return BestiaryType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Bestiary();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/bestiary/view-bestiary.html.twig';
    }
}