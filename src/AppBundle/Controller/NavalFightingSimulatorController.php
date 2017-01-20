<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Option;
use AppBundle\Entity\Ship;
use AppBundle\Service\DefaultManager;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NavalFightingSimulatorController
 * @package AppBundle\Controller\NavalFightingSimulatorController
 * @Route(path="/admin")
 */
class NavalFightingSimulatorController extends BaseController
{
    /**
     * @return DefaultManager
     */
    public function getManagerShip()
    {
        return $this->get('cms_default_manager')->setRepository(Ship::class);
    }

    /**
     *
     * @return DefaultManager
     */
    public function getManagerEvent()
    {
        return $this->get('cms_event_manager')->setRepository(Event::class);
    }

    /**
     *
     * @return DefaultManager
     */
    public function getManagerOption()
    {
        return $this->get('cms_option_manager')->setRepository(Option::class);
    }

    /**
     * @Route("/navalfightingsimulator/", name="appbundle_naval_fighting_simulator_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navalFightingIndexAction()
    {
        return $this->render('@' . $this->getThemeAdmin() . '/ship/naval-fighting-simulator.html.twig', [
            'ships' => $this->getManagerShip()->getAll(),
        ]);
    }

    /**
     * @Route("/navalfightingsimulator/battle/", name="appbundle_naval_fighting_simulator_battle")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navalFightingBattleAction(Request $request)
    {
        $ship = NULL;
        $shipAdverse = NULL;

        if (!empty($request->get('shipSelect'))) $ship = $this->getManagerShip()->getEntityWith(array('id' => $request->get('shipSelect')));
        if (!empty($request->get('shipSelectAdverse')))  $shipAdverse = $this->getManagerShip()->getEntityWith(array('id' => $request->get('shipSelectAdverse')));

        if ($ship != NULL && $shipAdverse != NULL) $this->getManagerEvent()->addNewEvent($ship->getId() . "-" . $shipAdverse->getId(), "battle", "navalFightingSimulator");

        return $this->render('@' . $this->getThemeAdmin() . '/ship/naval-fighting-simulator.html.twig', [
            'ships' => $this->getManagerShip()->getAll(),
            'ship' => $ship,
            'shipAdverse' => $shipAdverse,
            'options' => $this->getOptionNavalFightingBattle(),
        ]);
    }

    /**
     * @Route("/navalfightingsimulator/stop/", name="appbundle_naval_fighting_simulator_stop")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navalFightingStopAction()
    {
        $this->getManagerEvent()->addNewEvent("stop", "stop", "navalFightingSimulator");

        return $this->render('@' . $this->getThemeAdmin() . '/ship/naval-fighting-simulator.html.twig', [
            'ships' => $this->getManagerShip()->getAll(),
        ]);
    }

    /**
     * @return array
     */
    protected function getOptionNavalFightingBattle(){
        $options['damageCanonShell'] = $this->getManagerOption()->selectOption("damageCanonShell")->getValue();
        $options['damageCanonCrew'] = $this->getManagerOption()->selectOption("damageCanonCrew")->getValue();
        $options['damageCanonCanon'] = $this->getManagerOption()->selectOption("damageCanonCanon")->getValue();
        $options['damageCrewCrew'] = $this->getManagerOption()->selectOption("damageCrewCrew")->getValue();

        return $options;
    }


    /**
     * @Route("/navalfightingsimulator/add_event/", name="appbundle_naval_fighting_simulator_add_event")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function customAddTestAction(Request $request)
    {
        try {
            if ($request->get('valeur') != "" && $request->get('animation') != "" && $request->get('for') != "" && $this->getManagerEvent()->addNewEvent($request->get('valeur'), $request->get('animation'), $request->get('for')) != NULL) {
                return new Response($this->get('jms_serializer')->serialize($this->getManagerEvent()->getEntity(), "json"));
            }else{
                return new Response("not value for addNewEvent (valeur, animation, for)", 404);
            }
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }
}
