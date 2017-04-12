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

      return $this->render('default/dashboard.html.twig', array(
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

      return $this->render('default/mosaique.html.twig', array(
          'agents' => $agents,
          'pagination' => $pagination,
      ));
    }

    /**
     * @Route("/agent/nombre", name="admin_agent_nombre")
     */
    public function nombreAction()
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Agent')->getNombreAgent();

      return $this->render('default/agent_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/recherche/total", name="admin_recherche_total")
     */
    public function recherchetotalAction()
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Recherche')->getNombreTotalRecherche();

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/recherche/mois-encours", name="admin_recherche_mois_encours")
     */
    public function recherchemoisencoursAction()
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Recherche')->getNombreRechercheDuMoisEncours();

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/recherche/annee", name="admin_recherche_annee")
     */
    public function recherchemoisanneeAction()
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Recherche')->getNombreRechercheAnneeEncours();

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/recherche/pourcentage", name="admin_recherche_pourcentage")
     */
    public function recherchepourcentageAction()
    {
      $em = $this->getDoctrine()->getManager();

      $annee = $em->getRepository('AppBundle:Recherche')->getNombreRechercheAnneeEncours();
      $mois = $em->getRepository('AppBundle:Recherche')->getNombreRechercheDuMoisEncours();

      $nombre = round($mois*100/$annee, 1);

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/recherche/{mois}", name="mois")
     */
    public function moisAction($mois)
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Recherche')->getNombreRechercheMois($mois);

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/liste-des-recherches", name="admin_recherche_listes")
     */
    public function recherchelisteAction()
    {
      $em = $this->getDoctrine()->getManager();

      $recherches = $em->getRepository('AppBundle:Recherche')->findAllOrderedByDate();

      return $this->render('recherche/index.html.twig', array(
          'recherches' => $recherches,
      ));
    }

    /**
     * @Route("/recherche-agent/{matricule}", name="admin_recherche_agent")
     */
    public function agentmatriculeAction($matricule)
    {
      $em = $this->getDoctrine()->getManager();

      $agent = $em->getRepository('AppBundle:Agent')->findOneByMatricule($matricule);

      return $this->render('default/recherche_agent.html.twig', array(
          'agent' => $agent,
      ));
    }

    /**
     * @Route("/agent-par-service/{id}", name="service_agent_nombre")
     */
    public function serviceagentnombreAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Agent')->getNombreAgentParService($id);

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/service/{id}/liste-des-agents", name="service_agent_liste")
     */
    public function serviceagentlisteAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $agents = $em->getRepository('AppBundle:Agent')->findByService($id);

      $service = $em->getRepository('AppBundle:Service')->findOneById($id);

      return $this->render('default/agent_liste_service.html.twig', array(
          'agents' => $agents,
          'service' => $service,
      ));
    }

    /**
     * @Route("/agent-par-grade/{id}", name="grade_agent_nombre")
     */
    public function gradeagentnombreAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Agent')->getNombreAgentParGrade($id);

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/grade/{id}/liste-des-agents", name="grade_agent_liste")
     */
    public function gradeagentlisteAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $agents = $em->getRepository('AppBundle:Agent')->findByGrade($id);

      $grade = $em->getRepository('AppBundle:Grade')->findOneById($id);

      return $this->render('default/agent_liste_grade.html.twig', array(
          'agents' => $agents,
          'grade' => $grade,
      ));
    }

    /**
     * @Route("/agent-par-echelon/{id}", name="echelon_agent_nombre")
     */
    public function echelonagentnombreAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Agent')->getNombreAgentParEchelon($id);

      return $this->render('default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/echelon/{id}/liste-des-agents", name="echelon_agent_liste")
     */
    public function echelonagentlisteAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $agents = $em->getRepository('AppBundle:Agent')->findByEchelon($id);

      $echelon = $em->getRepository('AppBundle:Echelon')->findOneById($id);

      return $this->render('default/agent_liste_echelon.html.twig', array(
          'agents' => $agents,
          'echelon' => $echelon,
      ));
    }
}
