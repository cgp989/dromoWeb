<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\LocalComercial;
use AppBundle\Form\LocalComercialType;

/**
 * LocalComercial controller.
 *
 */
class LocalComercialController extends Controller
{

    /**
     * Lists all LocalComercial entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:LocalComercial')->findAll();

        return $this->render('AppBundle:LocalComercial:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new LocalComercial entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new LocalComercial();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setVersion(1);
            $entity->setValoracion(0);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('localcomercial_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:LocalComercial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a LocalComercial entity.
     *
     * @param LocalComercial $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(LocalComercial $entity)
    {
        $form = $this->createForm(new LocalComercialType(), $entity, array(
            'action' => $this->generateUrl('localcomercial_create'),
            'method' => 'POST',
        ));

        $form->add('crear', 'submit', array('label' => 'Crear', 'attr' => ['class' => 'btn btn-primary']));

        return $form;
    }

    /**
     * Displays a form to create a new LocalComercial entity.
     *
     */
    public function newAction()
    {
        $entity = new LocalComercial();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:LocalComercial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a LocalComercial entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:LocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el Local Comercial.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:LocalComercial:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing LocalComercial entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:LocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('no existe el Local Comercial.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:LocalComercial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a LocalComercial entity.
    *
    * @param LocalComercial $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(LocalComercial $entity)
    {
        $form = $this->createForm(new LocalComercialType(), $entity, array(
            'action' => $this->generateUrl('localcomercial_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('actualizar', 'submit', array('label' => 'Actualizar', 'attr' => ['class' => 'btn btn-primary']));

        return $form;
    }
    /**
     * Edits an existing LocalComercial entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:LocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el Local Comercial.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $version = $entity->getVersion();
            $entity->setVersion($version+1);
            $em->flush();

            return $this->redirect($this->generateUrl('localcomercial_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:LocalComercial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a LocalComercial entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:LocalComercial')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No existe el Local Comercial.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('localcomercial'));
    }

    /**
     * Creates a form to delete a LocalComercial entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('localcomercial_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('eliminar', 'submit', array('label' => ' ',
                            'attr' =>
                            ['class' => 'glyphicon glyphicon-trash',
                                'onclick' => 'return confirm("¿Esta seguro de eliminar este Local Comercial?")',
                                'title' => 'eliminar']
                        ))
            ->getForm()
        ;
    }
}
