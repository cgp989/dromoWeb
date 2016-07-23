<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Form\Listener\AddLocalidadFieldSubscriber;
use AppBundle\Form\Listener\AddProvinciaFieldSubscriber;

class DireccionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', null, array(
                    'label' => 'Dirección',
                    'required' => true
                ))
            ->add('latitud', null, array(
                    'label' => 'Latitud',
                    'required' => true
                ))
            ->add('longitud', null, array(
                    'label' => 'Longitud',
                    'required' => true
                ));
//            ->add('provincia', 'entity', array(
//                'class' => 'AppBundle:Provincia',
//                'mapped' => false,
//                'empty_value'  => 'Seleccione una provincia'))
//            ->add('localidad', 'entity', array(
//                'class' => 'AppBundle:Localidad',
//                'empty_value'  => 'Seleccione una localidad',
//                'disabled' => true));        
        
        // Añadimos un EventListener que actualizará el campo localidad
        // para que sus opciones correspondan
        // con la provincia seleccionada
        $builder->addEventSubscriber(new AddLocalidadFieldSubscriber());
        $builder->addEventSubscriber(new AddProvinciaFieldSubscriber());
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Direccion',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_direccion';
    }
}
