<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function indexAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      //$users = $em->getRepository('AppBundle:User')->findAll();

      return $this->render('Default/dashboard.html.twig', array(
          //'users' => $users,
      ));
    }

    /**
     * @Route("/agent/{page}/liste-mosaique-des-agents", requirements={"page" = "\d+"}, name="admin_agent_mosaique")
     *
     * @param int $page Le numéro de la page
     */
    public function mosaiqueAction($page)
    {
      $em = $this->getDoctrine()->getManager();

      $nbAgentParPage = 9;

      $agents = $em->getRepository('AppBundle:Agent')->getMosaique($page, $nbAgentParPage);

      $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($agents) / $nbAgentParPage),
            'nomRoute' => 'admin_agent_mosaique',
            'paramsRoute' => array()
        );

      return $this->render('Default/mosaique.html.twig', array(
          'agents' => $agents,
          'pagination' => $pagination,
      ));
    }
}
