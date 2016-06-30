<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VisitaLocalComercial;
use AppBundle\Form\VisitaLocalComercialType;

/**
 * VisitaLocalComercial controller.
 *
 */
class VisitaLocalComercialController extends Controller
{

    /**
     * Lists all VisitaLocalComercial entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:VisitaLocalComercial')->getVisitas();

        return $this->render('AppBundle:VisitaLocalComercial:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new VisitaLocalComercial entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new VisitaLocalComercial();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('visitalocalcomercial_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:VisitaLocalComercial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VisitaLocalComercial entity.
     *
     * @param VisitaLocalComercial $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VisitaLocalComercial $entity)
    {
        $form = $this->createForm(new VisitaLocalComercialType(), $entity, array(
            'action' => $this->generateUrl('visitalocalcomercial_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VisitaLocalComercial entity.
     *
     */
    public function newAction()
    {
        $entity = new VisitaLocalComercial();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:VisitaLocalComercial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VisitaLocalComercial entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VisitaLocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VisitaLocalComercial entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VisitaLocalComercial:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VisitaLocalComercial entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VisitaLocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VisitaLocalComercial entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VisitaLocalComercial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a VisitaLocalComercial entity.
    *
    * @param VisitaLocalComercial $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VisitaLocalComercial $entity)
    {
        $form = $this->createForm(new VisitaLocalComercialType(), $entity, array(
            'action' => $this->generateUrl('visitalocalcomercial_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VisitaLocalComercial entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VisitaLocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VisitaLocalComercial entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('visitalocalcomercial_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:VisitaLocalComercial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a VisitaLocalComercial entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:VisitaLocalComercial')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VisitaLocalComercial entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('visitalocalcomercial'));
    }

    /**
     * Creates a form to delete a VisitaLocalComercial entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('visitalocalcomercial_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
