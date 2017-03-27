<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recherche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Recherche controller.
 *
 * @Route("recherche")
 */
class RechercheController extends Controller
{
    /**
     * Lists all recherche entities.
     *
     * @Route("/", name="recherche_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recherches = $em->getRepository('AppBundle:Recherche')->findAll();

        return $this->render('recherche/index.html.twig', array(
            'recherches' => $recherches,
        ));
    }

    /**
     * Creates a new recherche entity.
     *
     * @Route("/agent", name="recherche_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $recherche = new Recherche();
        $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recherche);
            //$em->flush();

            // Recuperation du matricule recherché
            // Recherche de l'agent concerné
            $matricule = $recherche->getMatricule();

            $agent = $em->getRepository('AppBundle:Agent')->findOneByMatricule($matricule);

            if ($agent) {

              $em->flush();
              return $this->render('recherche/new.html.twig', array(
                  'recherche' => $recherche,
                  'form' => $form->createView(),
                  'agent' => $agent,
              ));
            } else {
              $this->addFlash('alert', "Le matricule ".$matricule." ne correspond à aucun agent du ministère!!");
              return $this->render('recherche/error.html.twig', array(
                  'recherche' => $recherche,
                  'form' => $form->createView(),
                  'agent' => $agent,
              ));
            }



        }

        return $this->render('recherche/new.html.twig', array(
            'recherche' => $recherche,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recherche entity.
     *
     * @Route("/{id}", name="recherche_show")
     * @Method("GET")
     */
    public function showAction(Recherche $recherche)
    {
        $deleteForm = $this->createDeleteForm($recherche);

        return $this->render('recherche/show.html.twig', array(
            'recherche' => $recherche,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recherche entity.
     *
     * @Route("/{id}/edit", name="recherche_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Recherche $recherche)
    {
        $deleteForm = $this->createDeleteForm($recherche);
        $editForm = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recherche_edit', array('id' => $recherche->getId()));
        }

        return $this->render('recherche/edit.html.twig', array(
            'recherche' => $recherche,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recherche entity.
     *
     * @Route("/{id}", name="recherche_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Recherche $recherche)
    {
        $form = $this->createDeleteForm($recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recherche);
            $em->flush();
        }

        return $this->redirectToRoute('recherche_index');
    }

    /**
     * Creates a form to delete a recherche entity.
     *
     * @param Recherche $recherche The recherche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Recherche $recherche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recherche_delete', array('id' => $recherche->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
