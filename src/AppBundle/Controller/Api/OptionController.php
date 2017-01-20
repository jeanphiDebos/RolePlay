<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\AbstractApiController;
use AppBundle\Entity\Option;
use AppBundle\Form\OptionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class OptionController extends AbstractApiController
{
    /**
     * @return object
     */
    public function getClassObject()
    {
        return Option::class;
    }

    /**
     * @Route("/api/option/list/{format}", name="appbundle_api_option_index", defaults={"format": "json"})
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($format)
    {
        return parent::indexAction($format);
    }

    /**
     * @Route("/api/view/option/{id}/{format}", name="appbundle_api_option_view", defaults={"format": "json"})
     * @param int $id
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $format)
    {
        return parent::viewAction($id, $format);
    }

    /**
     * @Route("/api/edit/option/{id}/{format}", name="appbundle_api_option_edit", defaults={"format": "json"}, requirements={
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
     * @Route("/api/option/add/{format}", name="appbundle_api_option_add", defaults={"format": "json"})
     * @param Request $request
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, $format)
    {
        return parent::addAction($request, $format);
    }

    /**
     * @Route("/api/remove/option/{id}/{format}", name="appbundle_api_option_remove", defaults={"format": "json"}, requirements={
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
        return OptionType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Option();
    }
}