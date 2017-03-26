<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Echelon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Echelon controller.
 *
 * @Route("admin/echelon")
 */
class EchelonController extends Controller
{
    /**
     * Lists all echelon entities.
     *
     * @Route("/", name="admin_echelon_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $echelons = $em->getRepository('AppBundle:Echelon')->findAll();

        return $this->render('echelon/index.html.twig', array(
            'echelons' => $echelons,
        ));
    }

    /**
     * Creates a new echelon entity.
     *
     * @Route("/new", name="admin_echelon_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $echelon = new Echelon();
        $form = $this->createForm('AppBundle\Form\EchelonType', $echelon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($echelon);
            $em->flush();

            $this->addFlash('notice', "L'echelon ".$echelon->getLibelle()." a été crée avec succès.!");

            return $this->redirectToRoute('admin_echelon_index');
        }

        return $this->render('echelon/new.html.twig', array(
            'echelon' => $echelon,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a echelon entity.
     *
     * @Route("/{id}", name="admin_echelon_show")
     * @Method("GET")
     */
    public function showAction(Echelon $echelon)
    {
        $deleteForm = $this->createDeleteForm($echelon);

        return $this->render('echelon/show.html.twig', array(
            'echelon' => $echelon,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing echelon entity.
     *
     * @Route("/{slug}/edit", name="admin_echelon_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Echelon $echelon)
    {
        $deleteForm = $this->createDeleteForm($echelon);
        $editForm = $this->createForm('AppBundle\Form\EchelonType', $echelon);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', "L'echelon ".$echelon->getLibelle()." a été modifié avec succès.!");

            return $this->redirectToRoute('admin_echelon_index');
        }

        return $this->render('echelon/edit.html.twig', array(
            'echelon' => $echelon,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a echelon entity.
     *
     * @Route("/{id}", name="admin_echelon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Echelon $echelon)
    {
        $form = $this->createDeleteForm($echelon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($echelon);
            $em->flush();
        }

        return $this->redirectToRoute('admin_echelon_index');
    }

    /**
     * Creates a form to delete a echelon entity.
     *
     * @param Echelon $echelon The echelon entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Echelon $echelon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_echelon_delete', array('id' => $echelon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
