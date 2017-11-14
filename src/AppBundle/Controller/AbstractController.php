<?php

namespace AppBundle\Controller;

use AppBundle\Manager\DefaultManager;
use AppBundle\Manager\SolutionManager;
use AppBundle\Service\SolutionSearchService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractController
 * @package AppBundle\Controller
 */
abstract class AbstractController extends Controller implements BaseInterface
{
    //@todo add session flashbag
    /**
     * @param array       $getAllOption
     * @param mixed       $entities
     * @param string|null $indexView
     * @param array       $parametersRender
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexActionAbstract($getAllOption = [], $entities = null, $indexView = null, $parametersRender = [])
    {
        /** @noinspection PhpUndefinedMethodInspection */
        if ($entities === null) {
            $entities = $this->getManager()->getAllWith(
                (isset($getAllOption['options'])) ? $getAllOption['options'] : [],
                (isset($getAllOption['orderBy'])) ? $getAllOption['orderBy'] : null,
                (isset($getAllOption['limit'])) ? $getAllOption['limit'] : null,
                (isset($getAllOption['offset'])) ? $getAllOption['offset'] : null
            );
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render(
            ($indexView) ? $indexView : $this->getIndexView(),
            array_merge($this->getParametersRenderIndex($entities), $parametersRender)
        );
    }

    /**
     * @param mixed       $id
     * @param string|null $view
     * @param array       $parametersRender
     * @param string|null $redirectToErrorRoute
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewActionAbstract($id, $view = null, $parametersRender = [], $redirectToErrorRoute = null)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $entity = $this->getManager()->getEntity($id);
        if (!$entity) {
            /** @noinspection PhpUndefinedMethodInspection */
            //@todo go to 404
            return $this->redirectToRoute(
                ($redirectToErrorRoute) ? $redirectToErrorRoute :
                    'appbundle_' . $this->getManager()->getClassNameLower() . '_index'
            );
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render(
            ($view) ? $view : $this->getView(),
            array_merge($this->getParametersRenderView($entity), $parametersRender)
        );
    }

    /**
     * @param Request     $request
     * @param mixed       $id
     * @param string|null $viewForm
     * @param array       $parametersRender
     * @param array       $optionsProcess
     * @param string|null $redirectToErrorRoute
     * @param string|null $redirectToSuccessErrorRoute
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editActionAbstract(
        Request $request,
        $id,
        $viewForm = null,
        $parametersRender = [],
        $optionsProcess = [],
        $redirectToErrorRoute = null,
        $redirectToSuccessErrorRoute = null
    ) {
        /** @var DefaultManager|mixed $manager */
        /** @noinspection PhpUndefinedMethodInspection */
        $manager = $this->getManager();
        $entity  = $manager->getEntity($id);
        if (!$entity) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirectToRoute(
                ($redirectToErrorRoute) ? $redirectToErrorRoute :
                    'appbundle_' . $this->getManager()->getClassNameLower() . '_index'
            );
        }
        /** @noinspection PhpUndefinedMethodInspection */
        $manager->setForm($this->createForm($this->getFormClass(), $entity), $request);
        if ($manager->process($optionsProcess)) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirectToRoute(
                ($redirectToSuccessErrorRoute) ? $redirectToSuccessErrorRoute :
                    'appbundle_' . $this->getManager()->getClassNameLower() . '_index'
            );
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render(
            ($viewForm) ? $viewForm : $this->getViewForm(),
            array_merge($this->getParametersRenderEdit($manager), $parametersRender)
        );
    }

    /**
     * @param Request     $request
     * @param string|null $viewForm
     * @param string|null $redirectToSuccessErrorRoute
     * @param array       $parametersRender
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addActionAbstract(
        Request $request,
        $viewForm = null,
        $parametersRender = [],
        $redirectToSuccessErrorRoute = null
    ) {
        /** @var DefaultManager|mixed $manager */
        /** @noinspection PhpUndefinedMethodInspection */
        $manager
            = $this->getManager()->setForm($this->createForm($this->getFormClass(), $this->getInitClass()), $request);
        /** @noinspection PhpUndefinedMethodInspection */
        if ($manager->process()) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirectToRoute(
                ($redirectToSuccessErrorRoute) ? $redirectToSuccessErrorRoute :
                    'appbundle_' . $this->getManager()->getClassNameLower() . '_index'
            );
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->render(
            ($viewForm) ? $viewForm : $this->getViewForm(),
            array_merge($this->getParametersRenderAdd($manager), $parametersRender)
        );
    }

    /**
     * @param mixed       $id
     * @param string|null $redirectToErrorRoute
     * @param string|null $redirectToSuccessErrorRoute
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeActionAbstract($id, $redirectToErrorRoute = null, $redirectToSuccessErrorRoute = null)
    {
        /** @var DefaultManager|mixed $manager */
        /** @noinspection PhpUndefinedMethodInspection */
        $manager = $this->getManager();
        $entity  = $manager->getEntity($id);
        if (!$entity) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->redirectToRoute(
                ($redirectToErrorRoute) ? $redirectToErrorRoute :
                    'appbundle_' . $this->getManager()->getClassNameLower() . '_index'
            );
        }
        $manager->remove($entity);

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->redirectToRoute(
            ($redirectToSuccessErrorRoute) ? $redirectToSuccessErrorRoute :
                'appbundle_' . $this->getManager()->getClassNameLower() . '_index'
        );
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return 'AppBundle:templates:form.html.twig';
    }

    /**
     * @param mixed $entities
     *
     * @return array
     */
    public function getParametersRenderIndex($entities)
    {
        return array_merge(
            [
                'entities' => $entities
            ],
            $this->getParametersRender()
        );
    }

    /**
     * @param mixed $entity
     *
     * @return array
     */
    public function getParametersRenderView($entity)
    {
        return array_merge(
            [
                'entity' => $entity
            ],
            $this->getParametersRender()
        );
    }

    /**
     * @param DefaultManager|mixed $manager
     *
     * @return array
     */
    public function getParametersRenderEdit($manager)
    {
        return array_merge(
            [
                'form' => $manager->getForm()->createView()
            ],
            $this->getParametersRender()
        );
    }

    /**
     * @param DefaultManager|mixed $manager
     *
     * @return array
     */
    public function getParametersRenderAdd($manager)
    {
        return array_merge(
            [
                'form' => $manager->getForm()->createView()
            ],
            $this->getParametersRender()
        );
    }

    /**
     * @return array
     */
    public function getParametersRender()
    {
        return [
            'user' => $this->getUser()
        ];
    }
}