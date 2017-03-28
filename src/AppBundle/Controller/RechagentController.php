<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rechagent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Rechagent controller.
 *
 * @Route("rechagent")
 */
class RechagentController extends Controller
{
    /**
     * Lists all rechagent entities.
     *
     * @Route("/", name="rechagent_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rechagents = $em->getRepository('AppBundle:Rechagent')->findAll();

        return $this->render('rechagent/index.html.twig', array(
            'rechagents' => $rechagents,
        ));
    }

    /**
     * Creates a new rechagent entity.
     *
     * @Route("/new", name="rechagent_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rechagent = new Rechagent();
        $form = $this->createForm('AppBundle\Form\RechagentType', $rechagent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $matricule = $rechagent->getMatricule();
            $pass = $rechagent->getPass();

            $agent = $em->getRepository('AppBundle:Agent')->findOneByMatricule($matricule);
            $agent1 = $em->getRepository('AppBundle:Agent')->findOneByDatepass($pass);

            if ($agent AND $agent1 )  {

              return $this->render('rechagent/new.html.twig', array(
                  'rechagent' => $rechagent,
                  'form' => $form->createView(),
                  'agent' => $agent,
              ));
            } else {
              $this->addFlash('alert', "Vous n'êtes pas identifié ou l'une des informations renseignée n'est pas correcte. Veuillez contacter la Direction des Ressources Humaines");
              return $this->render('rechagent/error.html.twig', array(
                  'rechagent' => $rechagent,
                  'form' => $form->createView(),
                  'agent' => $agent,
              ));
            }
        }

        return $this->render('rechagent/new.html.twig', array(
            'rechagent' => $rechagent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rechagent entity.
     *
     * @Route("/{id}", name="rechagent_show")
     * @Method("GET")
     */
    public function showAction(Rechagent $rechagent)
    {
        $deleteForm = $this->createDeleteForm($rechagent);

        return $this->render('rechagent/show.html.twig', array(
            'rechagent' => $rechagent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rechagent entity.
     *
     * @Route("/{id}/edit", name="rechagent_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rechagent $rechagent)
    {
        $deleteForm = $this->createDeleteForm($rechagent);
        $editForm = $this->createForm('AppBundle\Form\RechagentType', $rechagent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rechagent_edit', array('id' => $rechagent->getId()));
        }

        return $this->render('rechagent/edit.html.twig', array(
            'rechagent' => $rechagent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rechagent entity.
     *
     * @Route("/{id}", name="rechagent_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rechagent $rechagent)
    {
        $form = $this->createDeleteForm($rechagent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rechagent);
            $em->flush();
        }

        return $this->redirectToRoute('rechagent_index');
    }

    /**
     * Creates a form to delete a rechagent entity.
     *
     * @param Rechagent $rechagent The rechagent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rechagent $rechagent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rechagent_delete', array('id' => $rechagent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
