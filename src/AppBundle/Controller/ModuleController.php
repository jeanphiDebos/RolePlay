<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Module;
use AppBundle\Form\ModuleType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ModuleController
 * @package AppBundle\Controller\ModuleController
 * @Route(path="/admin")
 */
class ModuleController extends AbstractController implements BaseInterface
{
    /**
     * @param Module $entity
     */
    public function initOptions($entity)
    {
        $this->options = array("universe" => array());
        foreach ($entity->getUniverses() as $universe) {
            $this->options['universe'][] = $universe;
        }
    }

    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_module_manager')->setRepository(Module::class);
    }

    /**
     * @Route("/module/", name="appbundle_module_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/module/view/{id}", name="appbundle_module_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/module/add", name="appbundle_module_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/module/edit/{id}", name="appbundle_module_edit", requirements={
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
     * @Route("/module/remove/{id}", name="appbundle_module_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/module/list-module.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'module';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return ModuleType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Module();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/module/view-module.html.twig';
    }
}