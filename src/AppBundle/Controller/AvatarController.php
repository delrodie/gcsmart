<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Avatar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Avatar controller.
 *
 * @Route("avatar")
 */
class AvatarController extends Controller
{
    /**
     * Lists all avatar entities.
     *
     * @Route("/", name="avatar_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avatars = $em->getRepository('AppBundle:Avatar')->findAll();

        return $this->render('avatar/index.html.twig', array(
            'avatars' => $avatars,
        ));
    }

    /**
     * Creates a new avatar entity.
     *
     * @Route("/new", name="avatar_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $avatar = new Avatar();
        $form = $this->createForm('AppBundle\Form\AvatarType', $avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avatar);
            $em->flush();

            return $this->redirectToRoute('avatar_show', array('id' => $avatar->getId()));
        }

        return $this->render('avatar/new.html.twig', array(
            'avatar' => $avatar,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a avatar entity.
     *
     * @Route("/{id}", name="avatar_show")
     * @Method("GET")
     */
    public function showAction(Avatar $avatar)
    {
        $deleteForm = $this->createDeleteForm($avatar);

        return $this->render('avatar/show.html.twig', array(
            'avatar' => $avatar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing avatar entity.
     *
     * @Route("/{id}/edit", name="avatar_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Avatar $avatar)
    {
        $deleteForm = $this->createDeleteForm($avatar);
        $editForm = $this->createForm('AppBundle\Form\AvatarType', $avatar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avatar_edit', array('id' => $avatar->getId()));
        }

        return $this->render('avatar/edit.html.twig', array(
            'avatar' => $avatar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a avatar entity.
     *
     * @Route("/{id}", name="avatar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Avatar $avatar)
    {
        $form = $this->createDeleteForm($avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avatar);
            $em->flush();
        }

        return $this->redirectToRoute('avatar_index');
    }

    /**
     * Creates a form to delete a avatar entity.
     *
     * @param Avatar $avatar The avatar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Avatar $avatar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avatar_delete', array('id' => $avatar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
