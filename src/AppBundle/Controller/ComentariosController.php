<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Comentario;
use AppBundle\Form\ComentariosType;

/**
 * Comentario controller.
 *
 */
class ComentariosController extends Controller {

    /**
     * Lists all Comentario entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Comentario')->getComentariosDenunciados();

        return $this->render('AppBundle:Comentarios:index.html.twig', array(
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

            return $this->redirect($this->generateUrl('comentarios_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Comentarios:new.html.twig', array(
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
        $form = $this->createForm(new ComentariosType(), $entity, array(
            'action' => $this->generateUrl('comentarios_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Comentario entity.
     *
     */
    public function newAction() {
        $entity = new Comentario();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Comentarios:new.html.twig', array(
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

        return $this->render('AppBundle:Comentarios:show.html.twig', array(
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
            throw $this->createNotFoundException('Comentario no disponible.');
        }
        $estadoComentario = $em->getRepository('AppBundle:EstadoComentario')->findOneByNombre('Activo');
        $entity->setEstadoComentario($estadoComentario);
        $em->flush();
        return $this->redirect($this->generateUrl('comentarios'));
    }

    /**
     * Creates a form to edit a Comentario entity.
     *
     * @param Comentario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Comentario $entity) {
        $form = $this->createForm(new ComentariosType(), $entity, array(
            'action' => $this->generateUrl('comentarios_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('actualizar', 'submit', array('label' => 'Actualizar', 'attr' => ['class' => 'btn btn-primary']));

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
            throw $this->createNotFoundException('Comentario no disponible!.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('comentarios_show', array('id' => $id)));
        }

        return $this->render('AppBundle:Comentarios:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comentario entity.
     *
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Comentario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Comentario no disponible.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('comentarios'));
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
                        ->setAction($this->generateUrl('comentarios_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('eliminar', 'submit', array('label' => ' ',
                            'attr' =>
                            ['class' => 'glyphicon glyphicon-trash swa-confirm',
                                'title' => 'eliminar',
                                'swa-title' => 'Está seguro de eliminar este comentario?',
                                'swa-text' => ' ',
                                'swa-btn-txt' => 'Eliminar']
                        ))
                        ->getForm()
        ;
    }

}
