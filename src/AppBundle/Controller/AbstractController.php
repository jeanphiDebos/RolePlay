<?php
namespace AppBundle\Controller;

use AppBundle\Service\DefaultManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractController
 * @package AppBundle\Controller
 */
class AbstractController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $entities = $this->getManager()->getAll();
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render($this->getIndexView(), [
            'entities' => $entities,
            'title' => $this->getManager()->getClassNameLower(),
            'name' => $this->get('translator')->trans($this->getManager()->getClassNameLower() . '.label.list')
        ]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        /** @var DefaultManager|mixed $manager */
        /** @noinspection PhpUndefinedMethodInspection */
        $manager = $this->getManager();
        $entity = $manager->getEntity($id);
        if (!$entity) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirect($this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index'));
        }
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render($this->getView(), [
            'entity' => $entity,
            'title' => $this->getManager()->getClassNameLower(),
            'name' => $this->getNameForView($entity)
        ]);
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function getNameForView($entity)
    {
        if (is_callable([$entity, 'getName'])) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $entity->getName();
        } elseif (is_callable([$entity, 'getSubject'])) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $entity->getSubject();
        } elseif (is_callable([$entity, 'getFirstname'])) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $entity->getFirstname() . ' ' . $entity->getLastName();
        } else {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->getManager()->getClassNameLower();
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        /** @var DefaultManager|mixed $manager */
        /** @noinspection PhpUndefinedMethodInspection */
        $manager = $this->getManager();
        $entity = $manager->getEntity($id);
        if (!$entity) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirect($this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index'));
        }
        /** @noinspection PhpUndefinedMethodInspection */
        $manager->setForm($this->createForm($this->getFormClass(), $entity), $request);
        $this->initOptions($entity);
        if ($manager->process($this->options)) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirect($this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index'));
        }
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render($this->getViewForm(), array(
            'form' => $manager->getForm()->createView(),
            'label' => $this->getManager()->getClassNameLower() . '.label.edit',
            'breadcrumbs' => [
                ['name' => $this->getManager()->getClassNameLower() . '.label.name', 'url' => $this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index')],
                ['name' => $this->getManager()->getClassNameLower() . '.label.edit', 'url' => null]
            ]
        ));
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return '@' . $this->getThemeAdmin() . '/templates/form.html.twig';
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        /** @var DefaultManager|mixed $manager */
        /** @noinspection PhpUndefinedMethodInspection */
        $manager = $this->getManager()->setForm($this->createForm($this->getFormClass(), $this->getInitClass()), $request);
        /** @noinspection PhpUndefinedMethodInspection */
        if ($manager->process()) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirect($this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index'));
        }
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render($this->getViewForm(), array(
            'form' => $manager->getForm()->createView(),
            'label' => $this->getManager()->getClassNameLower() . '.label.add',
            'breadcrumbs' => [
                ['name' => $this->getManager()->getClassNameLower() . '.label.name', 'url' => $this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index')],
                ['name' => $this->getManager()->getClassNameLower() . '.label.add', 'url' => null]
            ]
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction($id)
    {
        /** @var DefaultManager|mixed $manager */
        /** @noinspection PhpUndefinedMethodInspection */
        $manager = $this->getManager();
        $entity = $manager->getEntity($id);
        if (!$entity) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirect($this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index'));
        }
        $manager->remove($entity);
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->redirect($this->generateUrl('appbundle_' . $this->getManager()->getClassNameLower() . '_index'));
    }
}