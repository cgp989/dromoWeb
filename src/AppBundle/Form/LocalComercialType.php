<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LocalComercialType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('descripcion')
                ->add('nombreContacto')
                ->add('emailContacto')
                ->add('telefonoContacto')
        ;

        if (isset($this->opciones['edit']) && $this->opciones['edit']) {
            $builder
                    ->add('usuario', null, array(
                        'label' => 'Tipo',
                        'disabled' => true,
                        'empty_value' => '',
            ));
        } else {
//            $builder->add('usuario', 'entity', array(
//                    'class' => 'AppBundle:Usuario',
//                    'query_builder' =>
//                    function (\AppBundle\Entity\UsuarioRepository $repositorio) {
//                        return $repositorio->createQueryBuilder('u');
////                                ->where('e.nombre != :nombreEstado')
////                                ->setParameter('nombreEstado', 'eliminada');
//                    },
//                    'label' => 'Usuario'
//                        )
//                );
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
        