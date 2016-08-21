<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\VisitaPromocion;
use AppBundle\Form\VisitaPromocionType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * VisitaPromocion controller.
 *
 */
class VisitaPromocionController extends Controller {

    /**
     * Lists all VisitaPromocion entities.
     *
     */
    public function indexAction() {
        return $this->render('AppBundle:VisitaPromocion:index.html.twig');
    }

    /**
     * Creates a new VisitaPromocion entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new VisitaPromocion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('visitapromocion_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:VisitaPromocion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VisitaPromocion entity.
     *
     * @param VisitaPromocion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VisitaPromocion $entity) {
        $form = $this->createForm(new VisitaPromocionType(), $entity, array(
            'action' => $this->generateUrl('visitapromocion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VisitaPromocion entity.
     *
     */
    public function newAction() {
        $entity = new VisitaPromocion();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:VisitaPromocion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VisitaPromocion entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VisitaPromocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VisitaPromocion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VisitaPromocion:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VisitaPromocion entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VisitaPromocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VisitaPromocion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VisitaPromocion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a VisitaPromocion entity.
     *
     * @param VisitaPromocion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(VisitaPromocion $entity) {
        $form = $this->createForm(new VisitaPromocionType(), $entity, array(
            'action' => $this->generateUrl('visitapromocion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing VisitaPromocion entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VisitaPromocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VisitaPromocion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('visitapromocion_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:VisitaPromocion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VisitaPromocion entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:VisitaPromocion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VisitaPromocion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('visitapromocion'));
    }

    /**
     * Creates a form to delete a VisitaPromocion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('visitapromocion_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    public function ajaxAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $tipo = $request->request->get('tipo');
        $desde = $request->request->get('desde');
        $hasta = $request->request->get('hasta');
        $idLocal = $this->getUser()->getLocalComercial()->getId();
        //echo $tipo;exit;
        $entity = null;
        if ($tipo == 1) {
            $entity = $em->getRepository('AppBundle:VisitaPromocion')->getVisitas($idLocal, $desde, $hasta);
        } else if ($tipo == 2) {
            $entity = $em->getRepository('AppBundle:VisitaPromocion')->getVisitasPorSexo($idLocal);
        } else if ($tipo == 3) {
            $entity = $em->getRepository('AppBundle:VisitaPromocion')->getCuponesPromocion($idLocal, $desde, $hasta);
        } else if ($tipo == 4) {
            $entity = $em->getRepository('AppBundle:VisitaPromocion')->getGananciaLocal($idLocal, $desde, $hasta);
        }
        $total = 0;
        if ($entity != null) {
            foreach ($entity as $u) {
                $total+= $u['cant'];
            }
        } else {
            return $this->render('AppBundle:VisitaPromocion:index.html.twig', array(
                        'tipo' => $tipo,
                        'suma' => $total,
            ));
        }
        $response = new JsonResponse();
        $response->setData(array(
            'entities' => $entity,
            'suma' => $total,
        ));
        return $response;
    }

}
