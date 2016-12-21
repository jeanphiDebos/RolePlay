<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class DefaultManager
 * @package AppBundle\Service
 */
class DefaultManager implements ManagerInterface
{
    /**
     * @var EntityManager
     */
    protected $em;
    /**
     * @var Entity
     */
    protected $entity;
    /**
     * @var array
     */
    protected $options;
    /**
     * @var Form
     */
    protected $form;
    /**
     * @var Session
     */
    protected $session;
    /**
     * @var EntityRepository
     */
    protected $repository;
    /**
     * @var Request
     */
    protected $request;

    /**
     * ActivityManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->session = new Session();
    }

    public function setRepository($repository)
    {
        $this->repository = $this->em->getRepository($repository);
        return $this;
    }

    /**
     * @return string
     * Permet la récupération de la class en minuscule
     */
    public function getClassNameLower()
    {
        $classname = substr(strrchr($this->repository->getClassName(), '\\'), 1);
        $words = preg_split('/(?=[A-Z])/', $classname);

        $result = "";
        foreach ($words as $word) {
            if ($result != "") {
                $result .= "_";
            }
            $result .= $word;
        }
        return strtolower($result);
    }

    /**
     * @param $id
     * @return Entity|null|object
     */
    public function getEntity($id = null)
    {
        if ($id) {
            $this->entity = $this->repository->find($id);
            if (!$this->entity) {
                $this->session->getFlashBag()->add('danger', $this->getClassNameLower() . '.message.invalid_entity');
            }
        }
        return $this->entity;
    }

    /**
     * @param array $options
     * @return Entity|null|object
     */
    public function getEntityWith(array $options)
    {
        $this->entity = $this->repository->findOneBy($options);
        if (!$this->entity) {
            $this->session->getFlashBag()->add('danger', $this->getClassNameLower() . '.message.invalid_entity');
        }
        return $this->entity;
    }

    /**
     * @return Entity[]|array
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $options
     * @return array|\Doctrine\ORM\Mapping\Entity[]
     */
    public function getAllWith(array $options)
    {
        return $this->repository->findBy($options);
    }

    /**
     *
     */
    public function gestionOptions()
    {

    }

    /**
     * @param $entity
     * @return Entity
     */
    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    /**
     * @param $entity
     */
    public function remove($entity)
    {
        try {
            $this->em->remove($entity);
            $this->em->flush($entity);
            $this->session->getFlashBag()->add('success', $this->getClassNameLower() . '.message.success_remove');
        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('danger', $e->getMessage());
        }
    }

    /**
     * @param Form $form
     * @param Request $request
     * @return DefaultManager
     */
    public function setForm(Form $form, Request $request)
    {
        $this->form = $form;
        $this->request = $request;
        return $this;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param array $options
     * @return bool
     */
    public function process(array $options = array())
    {
        $this->options = $options;
        $this->form->handleRequest($this->request);
        if ($this->request->isMethod('post') && $this->form->isValid()) {
            return $this->success();
        }
        return false;
    }

    /**
     * @return bool
     */
    public function success()
    {
        try {
            $textFlashBag = "success_add";
            $this->entity = $this->form->getData();

            if ($this->entity->getId()){
                $textFlashBag = "success_edit";
            }

            $this->save($this->entity);
            $this->gestionOptions();

            $this->session->getFlashBag()->add('success', $this->getClassNameLower() . '.message.'.$textFlashBag);
            return true;
        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('danger', $e->getMessage());
            return false;
        }
    }
}