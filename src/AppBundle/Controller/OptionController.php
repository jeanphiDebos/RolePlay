<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Option;
use AppBundle\Form\OptionType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class OptionController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(Option::class);
    }

    /**
     * @Route("/option/", name="appbundle_option_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/option/view/{id}", name="appbundle_option_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/option/add", name="appbundle_option_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/option/edit/{id}", name="appbundle_option_edit", requirements={
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
     * @Route("/option/remove/{id}", name="appbundle_option_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/option/list-option.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'option';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return OptionType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Option();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/option/view-option.html.twig';
    }
}