<?php
/**
 * Created by PhpStorm.
 * User: jdebos
 * Date: 11/09/2017
 * Time: 11:57
 */

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\QueryBuilder;
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
    protected $optionsProcess;
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
     * DefaultManager constructor.
     *
     * @param EntityManager $em
     * @param Session       $session
     */
    public function __construct(EntityManager $em, Session $session)
    {
        $this->em      = $em;
        $this->session = $session;
    }

    /**
     * @param string $repository
     *
     * @return $this
     */
    public function setRepository($repository)
    {
        $this->repository = $this->em->getRepository($repository);

        return $this;
    }

    /**
     * @param $id
     *
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
     * @return string
     * Permet la récupération de la class en minuscule
     */
    public function getClassNameLower()
    {
        $classname = substr(strrchr($this->repository->getClassName(), '\\'), 1);
        $words     = preg_split('/(?=[A-Z])/', $classname);

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
     * @param array $options
     *
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
     * @param array      $options
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array|Entity[]
     */
    public function getAllWith(array $options, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($options, $orderBy, $limit, $offset);
    }

    /**
     * @param string   $alias
     * @param array    $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return QueryBuilder
     */
    public function getQueryBuilder($alias, array $orderBy = [], $limit = null, $offset = null)
    {
        $queryBuilder = $this->repository->createQueryBuilder($alias);

        return $this->defaultOptionQuery($queryBuilder, $orderBy, $limit, $offset);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $selectOne
     * @param string       $join
     * @param string       $selectJoin
     * @param Entity|mixed $objetFind
     *
     * @return QueryBuilder
     */
    protected function findLeftJoinEq($queryBuilder, $selectOne, $join, $selectJoin, $objetFind)
    {
        return $this->findLeftJoin(
            $queryBuilder,
            $selectOne,
            $join,
            $selectJoin,
            $queryBuilder->expr()->eq($selectJoin, ':' . $selectJoin),
            [$selectJoin => $objetFind]
        );
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $selectJoin
     * @param Entity|mixed $objetFind
     *
     * @return QueryBuilder
     */
    protected function andWhereEq($queryBuilder, $selectJoin, $objetFind)
    {
        return $queryBuilder->andWhere($queryBuilder->expr()->eq($selectJoin, ':' . $selectJoin))->setParameter(
            $selectJoin,
            $objetFind
        );
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $selectOne
     * @param string       $join
     * @param string       $selectJoin
     * @param array        $objetsFind
     *
     * @return QueryBuilder
     */
    protected function findLeftJoinIn($queryBuilder, $selectOne, $join, $selectJoin, $objetsFind)
    {
        return $this->findLeftJoin(
            $queryBuilder,
            $selectOne,
            $join,
            $selectJoin,
            $queryBuilder->expr()->in($selectJoin, ':' . $selectJoin),
            [$selectJoin => $objetsFind]
        );
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $selectJoin
     * @param array        $objetsFind
     *
     * @return QueryBuilder
     */
    protected function andWhereIn($queryBuilder, $selectJoin, $objetsFind)
    {
        return $queryBuilder->andWhere($queryBuilder->expr()->in($selectJoin, ':' . $selectJoin))->setParameter(
            $selectJoin,
            $objetsFind
        );
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $selectOne
     * @param string       $join
     * @param string       $selectJoin
     * @param mixed        $expr
     * @param array        $parameters
     *
     * @return QueryBuilder
     */
    protected function findLeftJoin($queryBuilder, $selectOne, $join, $selectJoin, $expr, $parameters = [])
    {
        $queryBuilder = $this->leftJoin($queryBuilder, $selectOne, $join, $selectJoin)->andWhere($expr);

        foreach ($parameters as $key => $value) {
            $queryBuilder = $queryBuilder->setParameter($key, $value);
        }

        return $queryBuilder;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $selectOne
     * @param string       $join
     * @param string       $selectJoin
     *
     * @return QueryBuilder
     */
    protected function leftJoin($queryBuilder, $selectOne, $join, $selectJoin)
    {
        return $queryBuilder->leftJoin($selectOne . '.' . $join, $selectJoin)->addSelect($selectJoin);
    }

    /**
     * @param QueryBuilder $query
     * @param array        $orderBy
     * @param int|null     $limit
     * @param int|null     $offset
     *
     * @return QueryBuilder
     */
    protected function defaultOptionQuery(QueryBuilder $query, array $orderBy = [], $limit = null, $offset = null)
    {
        return $this->orderBy($query, $orderBy)->setFirstResult($offset)->setMaxResults($limit);
    }

    /**
     * @param QueryBuilder $query
     * @param array        $orderBy
     *
     * @return QueryBuilder
     */
    protected function orderBy(QueryBuilder $query, array $orderBy)
    {
        foreach ($orderBy as $sort => $order) {
            $query->addOrderBy($sort, $order);
        }

        return $query;
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
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param Form    $form
     * @param Request $request
     *
     * @return DefaultManager
     */
    public function setForm(Form $form, Request $request)
    {
        $this->form    = $form;
        $this->request = $request;

        return $this;
    }

    /**
     * @param array $optionsProcess
     *
     * @return bool
     */
    public function process(array $optionsProcess = [])
    {
        $this->optionsProcess = $optionsProcess;
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

            if ($this->entity->getId()) {
                $textFlashBag = "success_edit";
            }

            $this->save($this->entity);
            $this->gestionOptions();

            $this->session->getFlashBag()->add('success', $this->getClassNameLower() . '.message.' . $textFlashBag);

            return true;
        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('danger', $e->getMessage());

            return false;
        }
    }

    /**
     * @param $entity
     *
     * @return Entity
     */
    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     *
     */
    public function gestionOptions()
    {

    }
}