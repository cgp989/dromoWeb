<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ProgramacionEnDia;
use AppBundle\Form\ProgramacionEnDiaType;

/**
 * ProgramacionEnDia controller.
 *
 */
class ProgramacionEnDiaController extends Controller
{

    /**
     * Lists all ProgramacionEnDia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ProgramacionEnDia')->getProgramacionesLocal($this->getUser()->getLocalComercial()->getId());

        return $this->render('AppBundle:ProgramacionEnDia:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
     /**
     * Lists all ProgramacionEnDia entities.
     *
     */
    public function premiosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ProgramacionEnDia')->getPremios();

        return $this->render('AppBundle:ProgramacionEnDia:indexPremios.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProgramacionEnDia entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProgramacionEnDia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('programacionendia_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:ProgramacionEnDia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProgramacionEnDia entity.
     *
     * @param ProgramacionEnDia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProgramacionEnDia $entity)
    {
        $form = $this->createForm(new ProgramacionEnDiaType(), $entity, array(
            'action' => $this->generateUrl('programacionendia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProgramacionEnDia entity.
     *
     */
    public function newAction()
    {
        $entity = new ProgramacionEnDia();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:ProgramacionEnDia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProgramacionEnDia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ProgramacionEnDia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProgramacionEnDia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:ProgramacionEnDia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProgramacionEnDia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ProgramacionEnDia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProgramacionEnDia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:ProgramacionEnDia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProgramacionEnDia entity.
    *
    * @param ProgramacionEnDia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProgramacionEnDia $entity)
    {
        $form = $this->createForm(new ProgramacionEnDiaType(), $entity, array(
            'action' => $this->generateUrl('programacionendia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProgramacionEnDia entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ProgramacionEnDia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProgramacionEnDia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('programacionendia_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:ProgramacionEnDia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProgramacionEnDia entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:ProgramacionEnDia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProgramacionEnDia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('programacionendia'));
    }

    /**
     * Creates a form to delete a ProgramacionEnDia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('programacionendia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
