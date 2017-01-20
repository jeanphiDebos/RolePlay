<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 * @package AppBundle\Controller\DefaultController
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="app_home_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('@' . $this->getThemeAdmin() . '/dashboard/admin.html.twig');
        }else{
            return $this->render('@' . $this->getThemeAdmin() . '/dashboard/player.html.twig');
        }
    }

    /**
     * @Route("/bestiaries/", name="app_bestiaries_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bestiariesAction()
    {
        return $this->render('@' . $this->getThemeAdmin() . '/bestiary/bestiaries.html.twig');
    }

    /**
     * @Route("/themap/", name="app_map_mapping_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mapMappingAction()
    {
        return $this->render('@' . $this->getThemeAdmin() . '/map/map-mapping.html.twig');
    }

    /**
     * @Route("/whispermj/", name="app_whisper_mj_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function whisperMJAction()
    {
        return $this->render('@' . $this->getThemeAdmin() . '/whisper/whisper-mj.html.twig');
    }

    /**
     * @Route("/navalfighting/", name="app_naval_fighting_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navalFightingAction()
    {
        return $this->render('@' . $this->getThemeAdmin() . '/ship/naval-fighting.html.twig');
    }

    /**
     * @Route("/login", name="login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('@' . $this->getThemeAdmin() . '/default/login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ));
    }
}
