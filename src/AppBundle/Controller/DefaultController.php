<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recherche;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
      $recherche = new Recherche();
      $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
      $form->handleRequest($request);

        return $this->render('default/index.html.twig', array(
            'recherche' => $recherche,
            'form' => $form->createView(),
        ));
    }
}
