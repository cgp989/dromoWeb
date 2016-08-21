<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Programacion;
use AppBundle\Form\ProgramacionType;
use Symfony\Component\Form\FormError;

/**
 * Programacion controller.
 *
 */
class ProgramacionController extends Controller {

    /**
     * Lists all Programacion entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $repoProgramaciones = $em->getRepository('AppBundle:Programacion');
        $entities = $repoProgramaciones->getProgramacionesLocal($this->getUser()->getLocalComercial()->getId());

        return $this->render('AppBundle:Programacion:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Lists all Programacion entities.
     *
     */
    public function indexPromoAction($idPromocion) {
        $em = $this->getDoctrine()->getManager();

        $repoProgramaciones = $em->getRepository('AppBundle:Programacion');
        $entities = $repoProgramaciones->getProgramacionesPromocion($idPromocion);

        return $this->render('AppBundle:Programacion:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Programacion entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            if ($em->getRepository('AppBundle:Programacion')->validaFechaInicio($entity)) {
                if ($em->getRepository('AppBundle:Programacion')->validaFechaFin($entity)) {
                    if ($entity->getCantidad() < 0) {
                        $entity->setCantidad($entity->getCantidad() * -1);
                    }
                    $em->persist($entity);
                    $em->flush();

                    if ($em->getRepository('AppBundle:Programacion')->estaEnDiaProgramacion($entity))
                        $em->getRepository('AppBundle:ProgramacionEnDia')->insertProgramacion($entity);

                    return $this->redirect($this->generateUrl('programacion_promocion', array('idPromocion' => $entity->getPromocion()->getId())));
                }else {
                    $form->addError(new FormError('Fecha fin mayor a fecha inicio'));
                }
            } else {
                $form->addError(new FormError('Fecha de Inicio debe ser mayor a la actual.'));
            }
        }

        return $this->render('AppBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Programacion entity.
     *
     * @param Programacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Programacion $entity) {
        $form = $this->createForm(new ProgramacionType(array('idLocal' => $this->getUser()->getLocalComercial()->getId())), $entity, array(
            'action' => $this->generateUrl('programacion_create'),
            'method' => 'POST'
        ));

        $form->add('crear', 'submit', array('label' => 'Crear', 'attr' => ['class' => 'btn btn-primary']));
        return $form;
    }

    /**
     * Displays a form to create a new Programacion entity.
     *
     */
    public function newAction() {
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Programacion entity.
     *
     */
    public function newPromoAction($idPromocion) {
        $entity = new Programacion();
        $em = $this->getDoctrine()->getManager();

        $repoPromocion = $em->getRepository('AppBundle:Promocion');
        $promocion = $repoPromocion->findOneById($idPromocion);
        $entity->setPromocion($promocion);
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Programacion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Programacion entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la programacion.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Programacion:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Programacion entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la programacion.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Programacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Programacion entity.
     *
     * @param Programacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Programacion $entity) {
        $form = $this->createForm(new ProgramacionType(array('idLocal' => $this->getUser()->getLocalComercial()->getId(), 'edit' => true)), $entity, array(
            'action' => $this->generateUrl('programacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('actualizar', 'submit', array('label' => 'Actualizar', 'attr' => ['class' => 'btn btn-primary']));

        return $form;
    }

    /**
     * Edits an existing Programacion entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la programacion.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if ($em->getRepository('AppBundle:Programacion')->validaFechaFin($entity)) {
                if ($entity->getCantidad() < 0) {
                    $entity->setCantidad($entity->getCantidad() * -1);
                }
                $em->flush();

                if ($em->getRepository('AppBundle:Programacion')->estaEnDiaProgramacion($entity))
                    $em->getRepository('AppBundle:ProgramacionEnDia')->verificarProgramacion($entity);
                else
                    $em->getRepository('AppBundle:ProgramacionEnDia')->deleteProgramacion($entity);
                    return $this->redirect($this->generateUrl('programacion_promocion', array('idPromocion'=>$entity->getPromocion()->getId())));
    //              return $this->redirect($this->generateUrl('programacion_edit', array('id' => $id)));
            }else {
                $editForm->addError(new FormError('Fecha fin mayor a fecha inicio'));
            }
        }

        return $this->render('AppBundle:Programacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Programacion entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Programacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No existe la programacion.');
            }

            if ($em->getRepository('AppBundle:Programacion')->estaEnDiaProgramacion($entity))
                $em->getRepository('AppBundle:ProgramacionEnDia')->deleteProgramacion($entity);

            $estadoEliminada = $em->getRepository('AppBundle:EstadoProgramacion')->findOneByNombre('eliminada');
            $entity->setEstadoProgramacion($estadoEliminada);
            $em->persist($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('programacion'));
    }

    /**
     * Creates a form to delete a Programacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('programacion_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => ' ',
                            'attr' =>
                            ['class' => 'glyphicon glyphicon-trash swa-confirm',
                                'title' => 'eliminar',
                                'swa-title' => 'Está seguro de eliminar esta programación?',
                                'swa-text' => '',
                                'swa-btn-txt' => 'Eliminar']
                        ))
                        ->getForm()
        ;
    }

}
