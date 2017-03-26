<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grade;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Grade controller.
 *
 * @Route("admin/grade")
 */
class GradeController extends Controller
{
    /**
     * Lists all grade entities.
     *
     * @Route("/", name="admin_grade_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grades = $em->getRepository('AppBundle:Grade')->findAll();

        return $this->render('grade/index.html.twig', array(
            'grades' => $grades,
        ));
    }

    /**
     * Creates a new grade entity.
     *
     * @Route("/new", name="admin_grade_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $grade = new Grade();
        $form = $this->createForm('AppBundle\Form\GradeType', $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grade);
            $em->flush();

            $this->addFlash('notice', "Le grade ".$grade->getLibelle()." a été crée avec succès.!");

            return $this->redirectToRoute('admin_grade_index');
        }

        return $this->render('grade/new.html.twig', array(
            'grade' => $grade,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a grade entity.
     *
     * @Route("/{id}", name="admin_grade_show")
     * @Method("GET")
     */
    public function showAction(Grade $grade)
    {
        $deleteForm = $this->createDeleteForm($grade);

        return $this->render('grade/show.html.twig', array(
            'grade' => $grade,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing grade entity.
     *
     * @Route("/{slug}/edit", name="admin_grade_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Grade $grade)
    {
        $deleteForm = $this->createDeleteForm($grade);
        $editForm = $this->createForm('AppBundle\Form\GradeType', $grade);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', "Le grade ".$grade->getLibelle()." a été modifié avec succès.!");

            return $this->redirectToRoute('admin_grade_index');
        }

        return $this->render('grade/edit.html.twig', array(
            'grade' => $grade,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a grade entity.
     *
     * @Route("/{id}", name="admin_grade_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Grade $grade)
    {
        $form = $this->createDeleteForm($grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grade);
            $em->flush();
        }

        return $this->redirectToRoute('admin_grade_index');
    }

    /**
     * Creates a form to delete a grade entity.
     *
     * @param Grade $grade The grade entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Grade $grade)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_grade_delete', array('id' => $grade->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
