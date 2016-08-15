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
                ->add('descripcion', null, array(
                    'label' => 'Descripción'
                ))
                ->add('nombreContacto')
                ->add('emailContacto', 'email')
                ->add('telefonoContacto', 'text', array(
                    'label' => 'Teléfono contacto',
                    'attr' => array(
                        'maxlength' => 13
                    )
                ))
                 ->add('porcentajeCobro')
        ;

        if (!isset($this->opciones['edit'])) {
            $builder->add('usuario', new RegistrationFormType('AppBundle\Entity\Usuario'));
        }else{
            $builder->add('imageFile', 'vich_image', array(
                    'required'      => false,
                    'allow_delete'  => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                    'label' => 'Imagen'
            ));
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
