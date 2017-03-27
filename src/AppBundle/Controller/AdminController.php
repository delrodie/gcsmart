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

    /**
     * @Route("/agent/nombre", name="admin_agent_nombre")
     */
    public function nombreAction()
    {
      $em = $this->getDoctrine()->getManager();

      $nombre = $em->getRepository('AppBundle:Agent')->getNombreAgent();

      return $this->render('Default/agent_nombre.html.twig', array(
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

      return $this->render('Default/recherche_total_nombre.html.twig', array(
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

      return $this->render('Default/recherche_total_nombre.html.twig', array(
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

      return $this->render('Default/recherche_total_nombre.html.twig', array(
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

      $nombre = $mois*100/$annee;

      return $this->render('Default/recherche_total_nombre.html.twig', array(
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

      return $this->render('Default/recherche_total_nombre.html.twig', array(
          'nombre' => $nombre,
      ));
    }

    /**
     * @Route("/liste-des-recherches", name="admin_recherche_listes")
     */
    public function recherchelisteAction()
    {
      $em = $this->getDoctrine()->getManager();

      $recherches = $em->getRepository('AppBundle:Recherche')->findAll();

      return $this->render('recherche/index.html.twig', array(
          'recherches' => $recherches,
      ));
    }
}
