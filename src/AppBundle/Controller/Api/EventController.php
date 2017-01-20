<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\AbstractApiController;
use AppBundle\Entity\Event;
use AppBundle\Form\EventType;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class EventController extends AbstractApiController
{
    /**
     * @return object
     */
    public function getClassObject()
    {
        return Event::class;
    }

    /**
     * @Route("/api/event/list/{format}", name="appbundle_api_event_index", defaults={"format": "json"})
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($format)
    {
        return parent::indexAction($format);
    }

    /**
     * @Route("/api/view/event/{id}/{format}", name="appbundle_api_event_view", defaults={"format": "json"})
     * @param int $id
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $format)
    {
        return parent::viewAction($id, $format);
    }

    /**
     * @Route("/api/edit/event/{id}/{format}", name="appbundle_api_event_edit", defaults={"format": "json"}, requirements={
     *     "id": "\d+"
     * })
     * @param Request $request
     * @param int $id
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id, $format)
    {
        return parent::editAction($request, $id, $format);
    }

    /**
     * @Route("/api/event/add/{format}", name="appbundle_api_event_add", defaults={"format": "json"})
     * @param Request $request
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, $format)
    {
        return parent::addAction($request, $format);
    }

    /**
     * @Route("/api/remove/event/{id}/{format}", name="appbundle_api_event_remove", defaults={"format": "json"}, requirements={
     *     "id": "\d+"
     * })
     * @param int $id
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function removeAction($id, $format)
    {
        return parent::removeAction($id, $format);
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
}