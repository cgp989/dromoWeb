<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddLocalidadFieldSubscriber
 *
 * @author CRISTIANGILBERTO
 */
namespace AppBundle\Form\Listener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddLocalidadFieldSubscriber implements EventSubscriberInterface{
    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SUBMIT => 'preSubmit',
            FormEvents::PRE_SET_DATA => 'preSetData',
        );
    }
    
    /**
     * Cuando el usuario llene los datos del formulario y haga el envío del mismo,
     * este método será ejecutado.
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        //data es un arreglo con los valores establecidos por el usuario en el form.

        //como $data contiene la provincia seleccionada por el usuario al enviar el formulario,
        // usamos el valor de la posicion $data['provincia'] para filtrar el sql de los estados
        $this->addField($event->getForm(), $data['provincia']);
    }

    protected function addField(Form $form, $provincia, $locSelected = null)
    {
        // actualizamos el campo localidad, pasandole la provincia a la opción
        // query_builder, para que el dql tome en cuenta la provincia
        // y filtre la consulta por su valor.
        $form->add('localidad', 'entity', array(
            'class' => 'AppBundle:Localidad',
            'empty_value'  => 'Seleccione una localidad',
            'query_builder' => function(EntityRepository $er) use ($provincia){
                return $er->createQueryBuilder('localidad')
                    ->where('localidad.provincia = :provincia')
                    ->setParameter('provincia', $provincia);
            },
            'data' => $locSelected
        ));
    }
    
    public function preSetData(FormEvent $event)
    {
        $direccion = $event->getData();
        $this->addFieldPreSet($event->getForm(), $direccion);
    }

    protected function addFieldPreSet(Form $form, $direccion = null)
    {
        if($direccion and $direccion->getLocalidad()){
            $provincia = $direccion->getLocalidad()->getProvincia();
            $this->addField($form, $provincia, $direccion->getLocalidad());
        }else{
            $provincia = null;
            $form->add('localidad', 'entity', array(
               'class' => 'AppBundle:Localidad',
               'empty_value'  => 'Seleccione una localidad',
               'disabled' => true));
        }
        
        $form->add('provincia', 'entity', array(
            'class' => 'AppBundle:Provincia',
            'mapped' => false, // importante indicar que el campo no está mapeado
            'data' => $provincia, //establecemos el valor inicial del campo.
            'empty_value'  => 'Seleccione una provincia'
        ));
    }
}
