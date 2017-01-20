<?php
namespace AppBundle\Controller;

use JMS\Serializer\SerializationContext;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractApiController extends BaseController
{
    /**
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($format)
    {
        try {
            $entities = $this->getManager()->getAll();

            $data = $this->get('jms_serializer')->serialize($entities, $format, SerializationContext::create()->enableMaxDepthChecks());

            return new Response($data);
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return mixed
     */
    public function getManager()
    {
        return $this->get($this->getServiceManager())->setRepository($this->getClassObject());
    }

    /**
     * @return string
     */
    public function getServiceManager()
    {
        return "cms_default_manager";
    }

    /**
     * @return object
     */
    public function getClassObject()
    {
        // TODO: Implement getClassObject() method.
    }

    /**
     * @param int $id
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $format)
    {
        try {
            $entity = $this->getManager()->getEntity($id);
            if (!$entity) {
                throw new Exception('entity not found', 404);
            }

            $data = $this->get('jms_serializer')->serialize($entity, $format, SerializationContext::create()->enableMaxDepthChecks());

            return new Response($data);
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id, $format)
    {
        try {
            $manager = $this->getManager();
            $entity = $manager->getEntity($id);

            if (!$entity) {
                throw new Exception('entity not found', 404);
            }

            $manager = $manager->setForm($this->createForm($this->getFormClass(), $entity), $request);
            $this->initOptions($entity);
            /** @noinspection PhpUndefinedMethodInspection */
            if ($manager->process($this->options)) {
                if ($format == "html") return new Response('entity edit');
                else return new Response($this->get('jms_serializer')->serialize('entity edit', $format));
            }

            if ($format == "html") {
                /** @noinspection PhpUndefinedMethodInspection */
                return $this->render($this->getViewForm(), array(
                    'form' => $manager->getForm()->createView()
                ));
            } else {
                /** @noinspection PhpUndefinedMethodInspection */
                $data = $this->get('jms_serializer')->serialize($manager->getForm()->createView(), $format);
                return new Response($data);
            }
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        // TODO: Implement getFormClass() method.
    }

    /**
     * @return mixed
     */
    public function getViewForm()
    {
        return 'form-api.html.twig';
    }

    /**
     * @param Request $request
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, $format)
    {
        try {
            $manager = $this->getManager()->setForm($this->createForm($this->getFormClass(), $this->getInitClass()), $request);
            /** @noinspection PhpUndefinedMethodInspection */
            if ($manager->process(['notifications' => false])) {
                return new Response($this->get('jms_serializer')->serialize($this->getManager()->getEntity(), $format));
            }

            if ($format == "html") {
                /** @noinspection PhpUndefinedMethodInspection */
                return $this->render($this->getViewForm(), array(
                    'form' => $manager->getForm()->createView(),
                    'action' => $this->generateUrl('appbundle_api_' . $this->getManager()->getClassNameLower() . '_add')
                ));
            } else {
                /** @noinspection PhpUndefinedMethodInspection */
                $data = $this->get('jms_serializer')->serialize($manager->getForm()->createView(), $format);
                return new Response($data);
            }
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return mixed
     */
    public function getInitClass()
    {
        // TODO: Implement getInitClass() method.
    }

    /**
     * @param int $id
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function removeAction($id, $format)
    {
        try {
            $manager = $this->getManager();
            $entity = $manager->getEntity($id);
            if (!$entity) {
                throw new Exception('entity not found', 404);
            }
            $manager->remove($entity);

            return new Response($this->get('jms_serializer')->serialize('entity deleted', $format));
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }
}