<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Comentario;
use AppBundle\Form\ComentarioType;

/**
 * Comentario controller.
 *
 */
class ComentarioController extends Controller {

    /**
     * Lists all Comentario entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Comentario')->getComentariosLocal($this->getUser()->getLocalComercial()->getId());

        return $this->render('AppBundle:Comentario:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Comentario entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Comentario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comentario_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Comentario:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Comentario entity.
     *
     * @param Comentario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Comentario $entity) {
        $form = $this->createForm(new ComentarioType(), $entity, array(
            'action' => $this->generateUrl('comentario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Comentario entity.
     *
     */
    public function newAction() {
        $entity = new Comentario();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Comentario:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comentario entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Comentario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Comentario no disponible!.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Comentario:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comentario entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Comentario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comentario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Comentario:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Comentario entity.
     *
     * @param Comentario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Comentario $entity) {
        $form = $this->createForm(new ComentarioType(), $entity, array(
            'action' => $this->generateUrl('comentario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Comentario entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Comentario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comentario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('comentario_show', array('id' => $id)));
        }

        return $this->render('AppBundle:Comentario:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comentario entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Comentario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Comentario no disponible.');
        }
        $estadoComentario = $em->getRepository('AppBundle:EstadoComentario')->findOneByNombre('Denunciado');
        $entity->setEstadoComentario($estadoComentario);
        $em->flush();


        return $this->redirect($this->generateUrl('comentario'));
    }

    /**
     * Creates a form to delete a Comentario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('comentario_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('eliminar', 'submit', array('label' => ' ',
                            'attr' =>
                            ['class' => 'glyphicon glyphicon-trash swa-confirm',
                                'title' => 'eliminar',
                                'swa-title' => 'Esta seguro de denunciar este comentario?',
                                'swa-text' => ' ',
                                'swa-btn-txt' => 'Denunciar']
                        ))
                        ->getForm()
        ;
    }

}
