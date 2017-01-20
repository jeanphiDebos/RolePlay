<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Whisper;
use AppBundle\Form\WhisperType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WhisperController
 * @package AppBundle\Controller\WhisperController
 * @Route(path="/admin")
 */
class WhisperController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(Whisper::class);
    }

    /**
     * @Route("/whisper/", name="appbundle_whisper_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/whisper/view/{id}", name="appbundle_whisper_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/whisper/add", name="appbundle_whisper_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/whisper/edit/{id}", name="appbundle_whisper_edit", requirements={
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
     * @Route("/whisper/remove/{id}", name="appbundle_whisper_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/whisper/list-whisper.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'whisper';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return WhisperType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Whisper();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/whisper/view-whisper.html.twig';
    }
}