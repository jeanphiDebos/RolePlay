<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Character;
use AppBundle\Form\CharacterType;
use AppBundle\Service\DefaultManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class CharacterController extends AbstractController implements BaseInterface
{
    /**
     * @return DefaultManager
     */
    public function getManager()
    {
        return $this->get('cms_default_manager')->setRepository(Character::class);
    }

    /**
     * @Route("/character/", name="appbundle_character_index")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/character/view/{id}", name="appbundle_character_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @Route("/character/add", name="appbundle_character_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        return parent::addAction($request);
    }

    /**
     * @Route("/character/edit/{id}", name="appbundle_character_edit", requirements={
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
     * @Route("/character/remove/{id}", name="appbundle_character_remove", requirements={
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
        return '@' . $this->getThemeAdmin() . '/character/list-character.html.twig';
    }

    /**
     * @return mixed
     */
    public function getNameObject()
    {
        return 'character';
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return '@' . $this->getThemeAdmin() . '/character/form-character.html.twig';
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return CharacterType::class;
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        return new Character();
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return '@' . $this->getThemeAdmin() . '/character/view-character.html.twig';
    }
}