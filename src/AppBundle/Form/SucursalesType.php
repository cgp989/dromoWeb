<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SucursalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telefono')
            ->add('direccion', null, array(
                        'label' => 'Direccion',
                        'disabled' => true,
                        'empty_value' => '',
            ))
            ->add('localComercial', null, array(
                        'label' => 'Local Comercial',
                        'disabled' => true,
                        'empty_value' => '',
            ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sucursal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_sucursales';
    }
}
