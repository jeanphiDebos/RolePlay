<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Form\Type\SelectedPlayerType;
use App\Form\Type\SelectedUniverseType;
use App\Repository\PlayerRepository;
use App\Repository\UniverseRepository;
use App\Entity\Player;
use App\Entity\User;

class RoleplayController extends Controller
{
    /**
     * @var User $user
     */
    private $user;

    /**
     * @var PlayerRepository $playerRepository
     */
    private $playerRepository;

    /**
     * @var UniverseRepository $universeRepository
     */
    private $universeRepository;

    public function __construct(Security $security, PlayerRepository $playerRepository, UniverseRepository $universeRepository)
    {
        $this->user = $security->getUser();
        $this->playerRepository = $playerRepository;
        $this->universeRepository = $universeRepository;
    }

    /**
     * @Route("/roleplay", name="roleplay")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SelectedPlayerType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var array $data
             * @var Player $player
             */
            $data = $form->getData();
            $player = $data['selectedPlayer'];

            return $this->redirectToRoute('player', ['idPlayer' => $player->getId()]);
        }

        return $this->render(
            'roleplay/index.html.twig',
            [
                'form'       => $form->createView(),
                'idPlayer' => null,
            ]
        );
    }

    /**
     * @Route("/roleplay/player/{idPlayer}", name="player")
     */
    public function rolePlayAction(string $idPlayer = null)
    {
        $player = $this->playerRepository->findOneBy(['id' => $idPlayer]);
        if (!$player) {
            return $this->redirectToRoute('roleplay');
        }

        return $this->render('roleplay/player.html.twig', [
            'idPlayer'     => $idPlayer,
            'player'       => $player,
            'fieldPlayers' => $player->getFieldPlayers(),
        ]);
    }

    /**
     * @Route("/roleplay/whisp/{idPlayer}", name="whisp")
     */
    public function rolePlayWhispAction(string $idPlayer = null)
    {
        $player = $this->playerRepository->findOneBy(['id' => $idPlayer]);
        if (!$player) {
            return $this->redirectToRoute('roleplay');
        }

        return $this->render('roleplay/whisp.html.twig', [
            'idPlayer'     => $idPlayer,
            'otherPlayers' => $this->playerRepository->otherPlayersToCurrentPlayer($player),
        ]);
    }

    /**
     * @Route("/roleplay/bestiary/{idPlayer}", name="bestiary")
     */
    public function rolePlayBestiaryAction(string $idPlayer = null)
    {
        $player = $this->playerRepository->findOneBy(['id' => $idPlayer]);
        if (!$player) {
            return $this->redirectToRoute('roleplay');
        }

        return $this->render('roleplay/bestiary.html.twig', [
            'idPlayer'   => $idPlayer,
            'bestiaries' => $player->getUniverse()->getBestiaries(),
        ]);
    }

    /**
     * @Route("/roleplay/map/{idPlayer}", name="map")
     */
    public function rolePlayMapAction(string $idPlayer = null)
    {
        $player = $this->playerRepository->findOneBy(['id' => $idPlayer]);
        if (!$player) {
            return $this->redirectToRoute('roleplay');
        }

        return $this->render('roleplay/map.html.twig', [
            'idPlayer' => $idPlayer,
            'maps'     => $player->getUniverse()->getMaps(),
        ]);
    }

    /**
     * @Route("/roleplay/public_map/{idUniverse}", name="public_map")
     */
    public function rolePlayPublicMapAction(Request $request, string $idUniverse = null)
    {
        $form = $this->createForm(SelectedUniverseType::class);
        $maps = [];

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var array $data
             * @var Universe $universe
             */
            $data = $form->getData();
            $universe = $data['selectedUniverse'];

            return $this->redirectToRoute('public_map', ['idUniverse' => $universe->getId()]);
        }

        if ($idUniverse) {
            $universe = $this->universeRepository->findOneBy(['id' => $idUniverse]);
            $maps     = $universe->getMaps();
        }

        return $this->render(
            'roleplay/public_map.html.twig',
            [
                'form'       => $form->createView(),
                'idUniverse' => $idUniverse,
                'maps'       => $maps,
            ]
        );
    }
}
