<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VariablesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcCobroLocal', null, array(
                    'label' => 'Porcentaje Comisión'
                ))
            ->add('porcGanancia', null, array(
                    'label' => 'Porcentaje Ganancia'
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Variables'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_variables';
    }
}
