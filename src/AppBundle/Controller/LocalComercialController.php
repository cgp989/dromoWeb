<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\LocalComercial;
use AppBundle\Form\LocalComercialType;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\FormError;

/**
 * LocalComercial controller.
 *
 */
class LocalComercialController extends Controller {

    /**
     * Lists all LocalComercial entities.
     *
     */
    public function indexAction() {
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
    public function createAction(Request $request) {
        $entity = new LocalComercial();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($entity->getPorcentajeCobro() > 0 && $entity->getPorcentajeCobro() < 100) {
                $em = $this->getDoctrine()->getManager();
                $entity->setVersion(1);
                $entity->setValoracion(0);
                $entity->setPorcentaje_Cobro($entity->getPorcentajeCobro());
                //se crea el usuario del local
                $userEntity = $entity->getUsuario();
                $userManipulator = $this->get('fos_user.util.user_manipulator');
                $usuario = $em->getRepository('AppBundle:Usuario')->findOneByusername($userEntity->getUsername());
                if ($usuario == null) {
                    $userNew = $userManipulator->create($userEntity->getUsername(), $userEntity->getPlainPassword(), $userEntity->getEmail(), true, false);
                    $userManipulator->addRole($userEntity->getUsername(), 'ROLE_LOCAL');
                    $userNew->setFirstLogin(true);
                    $entity->setUsuario($userNew);

                    $em->persist($entity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('sucursal_new_local', array('idLocal' => $entity->getId())));
                } else {
                    $form->addError(new FormError('EL usuario ya existe!'));
                }
            } else {
                $form->addError(new FormError('Porcentaje de cobro debe ser entre 0 y 100!'));
            }
        }
//        
        return $this->render('AppBundle:LocalComercial:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a LocalComercial entity.
     *
     * @param LocalComercial $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(LocalComercial $entity) {
        $form = $this->createForm(new LocalComercialType(array('admin'=>true)), $entity, array(
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
    public function newAction() {
        $entity = new LocalComercial();
        $em = $this->getDoctrine()->getManager();
        $repositoryVariable = $em->getRepository('AppBundle:Variables');
        $ArrayVariables = $repositoryVariable->findAll();
        $porcentajeCobro = $ArrayVariables[0]->getPorcCobroLocal();
        $entity->setPorcentajeCobro($porcentajeCobro * 100);
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:LocalComercial:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a LocalComercial entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:LocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el Local Comercial.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:LocalComercial:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing LocalComercial entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:LocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('no existe el Local Comercial.');
        }
        $entity->setPorcentajeCobro($entity->getPorcentaje_Cobro());
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:LocalComercial:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
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
    private function createEditForm(LocalComercial $entity) {
        $nameRouteUdpate = 'localcomercial_update';
        //Si el usuario es un local se cambia la url de actualizacion
        $isAdmin = true;
        if ($this->getUser()->hasRole('ROLE_LOCAL')) {
            $nameRouteUdpate = 'localcomercial_log_update';
            $isAdmin = false;
        }

        $form = $this->createForm(new LocalComercialType(array('edit' => true,'admin'=>$isAdmin)), $entity, array(
            'action' => $this->generateUrl($nameRouteUdpate, array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('actualizar', 'submit', array('label' => 'Actualizar', 'attr' => ['class' => 'btn btn-primary']));

        return $form;
    }

    /**
     * Edits an existing LocalComercial entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:LocalComercial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el Local.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if ($entity->getPorcentajeCobro() > 0 && $entity->getPorcentajeCobro() < 100) {
                $version = $entity->getVersion();
                $entity->setVersion($version + 1);
                $entity->setPorcentaje_Cobro($entity->getPorcentajeCobro());
                $em->flush();

                $urlEdit = $this->generateUrl('localcomercial_show', array('id' => $id));
                //Si el usuario es un local se cambia la url de actualizacion
                if ($this->getUser()->hasRole('ROLE_LOCAL')) {
                    $urlEdit = $this->generateUrl('localcomercial_log_edit');
                }

                return $this->redirect($urlEdit);
            } else {
                $editForm->addError(new FormError('Porcentaje de cobro debe ser entre 0 y 100!'));
            }
        }

        return $this->render('AppBundle:LocalComercial:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a LocalComercial entity.
     *
     */
    public function deleteAction(Request $request, $id) {
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
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('localcomercial_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('eliminar', 'submit', array('label' => ' ',
                            'attr' =>
                            ['class' => 'glyphicon glyphicon-trash swa-confirm',
                                'title' => 'eliminar',
                                'swa-title' => 'Esta seguro de eliminar este Local?',
                                'swa-text' => '',
                                'swa-btn-txt' => 'Eliminar']
                        ))
                        ->getForm()
        ;
    }

    public function showLogueadoAction() {
        return $this->showAction($this->getUser()->getLocalComercial()->getId());
    }

    public function editLogueadoAction() {
        return $this->editAction($this->getUser()->getLocalComercial()->getId());
    }

}
