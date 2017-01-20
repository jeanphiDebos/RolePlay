<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Form\EventType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EventController
 * @package AppBundle\Controller\EventController
 * @Route(path="/admin")
 */
class EventController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_event_manager')->setRepository(Event::class);
    }

    /**
     * @Route("/event/", name="appbundle_event_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/event/view/{id}", name="appbundle_event_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/event/add", name="appbundle_event_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/event/edit/{id}", name="appbundle_event_edit", requirements={
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
     * @Route("/event/remove/{id}", name="appbundle_event_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/event/list-event.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'event';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return EventType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Event();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/event/view-event.html.twig';
    }
}