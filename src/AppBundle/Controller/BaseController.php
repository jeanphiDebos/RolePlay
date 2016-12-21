<?php
namespace AppBundle\Controller;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class BaseController extends Controller
{
    /**
     * @var string
     */
    protected $theme;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var array
     */
    protected $options;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->theme = $this->container->getParameter('theme_admin');
        $this->session = $this->get('session');
    }

    /**
     * @return string
     */
    public function getThemeAdmin()
    {
        return $this->theme;
    }

    /**
     * @param Entity $entity
     */
    public function initOptions($entity)
    {
        $this->options = array();
    }
}