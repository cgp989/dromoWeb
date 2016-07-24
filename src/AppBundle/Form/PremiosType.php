<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PremiosType extends AbstractType {

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
                ->add('titulo', null, array(
                    'label' => 'Título'))
                ->add('descripcion', 'textarea', array(
                    'label' => 'Descripción'))
                ->add('precio', null, array('attr' => array(
                        'label' => 'Precio ($)',
                                                
            )))
                ->add('puntajePremio', 'integer', array('attr' => array(
                        'min' => '0',
            )))
                ->add('estadoPromocion', 'entity', array(
                    'class' => 'AppBundle:EstadoPromocion',
                    'query_builder' =>
                    function (\AppBundle\Entity\EstadoPromocionRepository $repositorio) {
                        return $repositorio->createQueryBuilder('e')
                                ->where('e.nombre != :nombreEstado')
                                ->setParameter('nombreEstado', 'eliminada');
                    },
                    'label' => 'Estado'
                        )
                )
                ->add('localComercial')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Promocion'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_promocion';
    }

}
