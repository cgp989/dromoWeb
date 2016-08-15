<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Variables;
use AppBundle\Form\VariablesType;

/**
 * Variables controller.
 *
 */
class VariablesController extends Controller {

    /**
     * Lists all Variables entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Variables')->findAll();

        return $this->render('AppBundle:Variables:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Variables entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Variables();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('variables_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Variables:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Variables entity.
     *
     * @param Variables $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Variables $entity) {
        $form = $this->createForm(new VariablesType(), $entity, array(
            'action' => $this->generateUrl('variables_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Variables entity.
     *
     */
    public function newAction() {
        $entity = new Variables();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Variables:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Variables entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Variables')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Variables entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Variables:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Variables entity.
     *
     */
    public function editAction() {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Variables')->find(1);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Variables entity.');
        }
        $entity->setPorcCobroLocal($entity->getPorcCobroLocal() * 100);
        $entity->setPorcGanancia($entity->getPorcGanancia() * 100);
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm(1);

        return $this->render('AppBundle:Variables:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Variables entity.
     *
     * @param Variables $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Variables $entity) {
        $form = $this->createForm(new VariablesType(), $entity, array(
            'action' => $this->generateUrl('variables_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('actualizar', 'submit', array('label' => 'Actualizar', 'attr' => ['class' => 'btn btn-primary']));

        return $form;
    }

    /**
     * Edits an existing Variables entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Variables')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Variables entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setPorcCobroLocal($entity->getPorcCobroLocal() / 100);
            $entity->setPorcGanancia($entity->getPorcGanancia() / 100);
            $em->flush();

            return $this->redirect($this->generateUrl('variables_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Variables:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Variables entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Variables')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Variables entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('variables'));
    }

    /**
     * Creates a form to delete a Variables entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('variables_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
