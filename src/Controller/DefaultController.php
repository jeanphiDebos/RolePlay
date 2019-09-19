<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('index.html.twig', []);
    }

    /**
     * @Route("/tnys", name="tate-no-yusha-skill")
     */
    public function tnysAction()
    {
        return $this->render('tate-no-yusha-skill/index.html.twig', []);
    }
    /**
     * @Route("/homestuck", name="homestuck")
     */
    public function homestuckAction()
    {
        return $this->render('homestuck-craft/homestuck.html.twig', []);
    }
}
