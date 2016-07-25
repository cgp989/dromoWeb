<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PromocionType extends AbstractType {

    private $opciones;

    public function __construct(array $opciones = null) {
        $this->opciones = $opciones;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $disableOption = (isset($this->opciones['edit']) && $this->opciones['edit']);
        $builder
            ->add('descripcion', 'textarea', array(
                'label' => 'Descripción'
            ))
            ->add('precio', null, array(
                'label' => 'Precio ($)',
                'disabled' => $disableOption
            ))
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
            ->add('titulo', null, array(
                'label' => 'Título',
                'disabled' => $disableOption
            ))
            ->add('tipoPromocion', null, array(
                'label' => 'Tipo',
                'empty_value' => '',
                'query_builder' => function (\AppBundle\Entity\TipoPromocionRepository $repositorio) {
                    return $repositorio->createQueryBuilder('e')
                            ->where('e.nombre != :nombrePromo')
                            ->setParameter('nombrePromo', 'Premio');
                },
                'disabled' => $disableOption
            ));
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
