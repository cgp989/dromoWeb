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

class AddProvinciaFieldSubscriber implements EventSubscriberInterface{
    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
        );
    }
    
    /**
     * Cuando el usuario llene los datos del formulario y haga el envío del mismo,
     * este método será ejecutado.
     */
    public function preSetData(FormEvent $event)
    {
        $direccion = $event->getData();
        $this->addField($event->getForm(), $direccion);
    }

    protected function addField(Form $form, $direccion = null)
    {
        if($direccion and $direccion->getLocalidad()){
            $provincia = $direccion->getLocalidad()->getProvincia();
        }else{
            $provincia = null;
        }
        
        $form->add('provincia', 'entity', array(
            'class' => 'AppBundle:Provincia',
            'mapped' => false, // importante indicar que el campo no está mapeado
            'data' => $provincia, //establecemos el valor inicial del campo.
            'empty_value'  => 'Seleccione una provincia'
        ));
    }
}
