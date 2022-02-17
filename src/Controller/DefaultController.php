<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PathfinderPlayerRepository;
use App\Repository\PathfinderBestiaryRepository;

class DefaultController extends Controller
{

    /**
     * @var PathfinderPlayerRepository $pathfinderPlayerRepository
     */
    private $pathfinderPlayerRepository;

    /**
     * @var PathfinderBestiaryRepository $pathfinderBestiaryRepository
     */
    private $pathfinderBestiaryRepository;

    public function __construct(PathfinderPlayerRepository $pathfinderPlayerRepository, PathfinderBestiaryRepository $pathfinderBestiaryRepository)
    {
        $this->pathfinderPlayerRepository = $pathfinderPlayerRepository;
        $this->pathfinderBestiaryRepository = $pathfinderBestiaryRepository;
    }

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

    /**
     * @Route("/combat_tracker_pathfinder", name="combat_tracker_pathfinder")
     */
    public function combatTrackerPathfinderAction()
    {
        $player = $this->pathfinderPlayerRepository->findAll();
        $bestiary = $this->pathfinderBestiaryRepository->findAll();

        return $this->render(
            'combat-tracker-pathfinder/index.html.twig',
            [
                'player'   => $player,
                'bestiary' => $bestiary,
            ]
        );
    }
}
