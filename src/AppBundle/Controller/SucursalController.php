<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Sucursal;
use AppBundle\Form\SucursalType;

/**
 * Sucursal controller.
 *
 */
class SucursalController extends Controller {

    /**
     * Lists all Sucursal entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Sucursal')->findAll();

        return $this->render('AppBundle:Sucursal:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Sucursal entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Sucursal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sucursal_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Sucursal:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Sucursal entity.
     *
     * @param Sucursal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sucursal $entity) {
        $form = $this->createForm(new SucursalType(), $entity, array(
            'action' => $this->generateUrl('sucursal_create'),
            'method' => 'POST',
        ));

        $form->add('crear', 'submit', array('label' => 'Crear', 'attr' => ['class' => 'btn btn-primary']));

        return $form;
    }

    /**
     * Displays a form to create a new Sucursal entity.
     *
     */
    public function newAction() {
        $entity = new Sucursal();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Sucursal:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sucursal entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sucursal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la Sucursal.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Sucursal:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Sucursal entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sucursal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la Sucursal.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Sucursal:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Sucursal entity.
     *
     * @param Sucursal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Sucursal $entity) {
        $form = $this->createForm(new SucursalType(), $entity, array(
            'action' => $this->generateUrl('sucursal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('actualizar', 'submit', array('label' => 'Actualizar', 'attr' => ['class' => 'btn btn-primary']));

        return $form;
    }

    /**
     * Edits an existing Sucursal entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sucursal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la Sucursal.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sucursal_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Sucursal:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Sucursal entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Sucursal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No existe la Sucursal.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sucursal'));
    }

    /**
     * Creates a form to delete a Sucursal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('sucursal_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('eliminar', 'submit', array('label' => ' ',
                            'attr' =>
                            ['class' => 'glyphicon glyphicon-trash',
                                'onclick' => 'return confirm("¿Esta seguro de eliminar esta Sucursal?")',
                                'title' => 'eliminar']
                        ))
                        ->getForm()
        ;
    }

}
