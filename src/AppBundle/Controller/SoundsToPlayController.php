<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SoundsToPlay;
use AppBundle\Form\SoundsToPlayType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class SoundsToPlayController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(SoundsToPlay::class);
    }

    /**
     * @Route("/sounds_to_play/", name="appbundle_sounds_to_play_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/sounds_to_play/view/{id}", name="appbundle_sounds_to_play_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/sounds_to_play/add", name="appbundle_sounds_to_play_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/sounds_to_play/edit/{id}", name="appbundle_sounds_to_play_edit", requirements={
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
     * @Route("/sounds_to_play/remove/{id}", name="appbundle_sounds_to_play_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/soundsToPlay/list-sounds-to-play.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'sounds_to_play';
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return '@' . $this->getThemeAdmin() . '/soundsToPlay/form-sounds-to-play.html.twig';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return SoundsToPlayType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new SoundsToPlay();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/soundsToPlay/view-sounds-to-play.html.twig';
    }
}