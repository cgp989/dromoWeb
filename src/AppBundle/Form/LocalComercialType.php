<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType;

class LocalComercialType extends AbstractType {

    private $opciones;

    public function __construct(array $opciones = null) {
        $this->opciones = $opciones;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('descripcion')
                ->add('nombreContacto')
                ->add('emailContacto', 'email')
                ->add('telefonoContacto', 'integer', array('attr' => array(
                        'min' => '99999',
            )))
        ;

        if (!isset($this->opciones['edit'])) {
            $builder->add('usuario', new RegistrationFormType('AppBundle\Entity\Usuario'));
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\LocalComercial'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_localcomercial';
    }

}
