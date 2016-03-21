<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Promocion;
use AppBundle\Form\PromocionType;

/**
 * Promocion controller.
 *
 */
class PromocionController extends Controller
{

    /**
     * Lists all Promocion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Promocion')->findAll();

        return $this->render('AppBundle:Promocion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Promocion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Promocion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('premio_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Promocion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Promocion entity.
     *
     * @param Promocion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Promocion $entity)
    {
        $form = $this->createForm(new PromocionType(), $entity, array(
            'action' => $this->generateUrl('premio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Promocion entity.
     *
     */
    public function newAction()
    {
        $entity = new Promocion();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Promocion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Promocion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Promocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Promocion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Promocion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Promocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Promocion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Promocion entity.
    *
    * @param Promocion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Promocion $entity)
    {
        $form = $this->createForm(new PromocionType(), $entity, array(
            'action' => $this->generateUrl('premio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Promocion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Promocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('premio_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Promocion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Promocion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Promocion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Promocion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('premio'));
    }

    /**
     * Creates a form to delete a Promocion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('premio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
