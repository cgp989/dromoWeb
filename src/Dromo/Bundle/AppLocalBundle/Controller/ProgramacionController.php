<?php

namespace Dromo\Bundle\AppLocalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Programacion;
use Dromo\Bundle\AppLocalBundle\Form\ProgramacionType;

/**
 * Programacion controller.
 *
 */
class ProgramacionController extends Controller
{
    private $idLocalLogueado = 76;

    /**
     * Lists all Programacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repoProgramaciones = $em->getRepository('AppBundle:Programacion');
        $entities = $repoProgramaciones->getProgramacionesLocal($this->idLocalLogueado);

        return $this->render('DromoAppLocalBundle:Programacion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Programacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Programacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            if($em->getRepository('AppBundle:Programacion')->estaEnDiaProgramacion($entity))
                $em->getRepository ('AppBundle:ProgramacionEnDia')->insertProgramacion($entity);

            return $this->redirect($this->generateUrl('programacion_show', array('id' => $entity->getId())));
        }

        return $this->render('DromoAppLocalBundle:Programacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Programacion entity.
     *
     * @param Programacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Programacion $entity)
    {
        $form = $this->createForm(new ProgramacionType(array('idLocal' => $this->idLocalLogueado)), $entity, array(
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
    public function newAction()
    {
        $entity = new Programacion();
        $form   = $this->createCreateForm($entity);

        return $this->render('DromoAppLocalBundle:Programacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Programacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la programacion.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DromoAppLocalBundle:Programacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Programacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la programacion.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DromoAppLocalBundle:Programacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
    private function createEditForm(Programacion $entity)
    {
        $form = $this->createForm(new ProgramacionType(array('idLocal' => $this->idLocalLogueado, 'edit' => true)), $entity, array(
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
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Programacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la programacion.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            
            if($em->getRepository('AppBundle:Programacion')->estaEnDiaProgramacion($entity))
                $em->getRepository ('AppBundle:ProgramacionEnDia')->insertProgramacion($entity);
            else
                $em->getRepository ('AppBundle:ProgramacionEnDia')->deleteProgramacion($entity);
                
            return $this->redirect($this->generateUrl('programacion_edit', array('id' => $id)));
        }

        return $this->render('DromoAppLocalBundle:Programacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Programacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Programacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No existe la programacion.');
            }

            if($em->getRepository('AppBundle:Programacion')->estaEnDiaProgramacion($entity))
                $em->getRepository ('AppBundle:ProgramacionEnDia')->deleteProgramacion($entity);
            
            $estadoEliminada=$em->getRepository('AppBundle:EstadoProgramacion')->findOneByNombre('eliminada');
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
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('programacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', 
                    array('label' => ' ',
                        'attr' => 
                            ['class' => 'glyphicon glyphicon-trash', 
                            'onclick' => 'return confirm("¿Esta seguro de eliminar esta porgramción?")',
                            'title' => 'eliminar']
                    ))
            ->getForm()
        ;
    } 
}
