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
        $disableOption = (isset($this->opciones['edit']) && $this->opciones['edit']);
        $builder
                ->add('titulo', null, array(
                    'label' => 'Título',
                    'disabled' => $disableOption))
                ->add('descripcion', 'textarea', array(
                    'label' => 'Descripción'))
                ->add('precio', 'number', array(
                    'label' => 'Precio ($)',
                    'attr' => array(
                        'min' => '0',
                    'disabled' => $disableOption                        
            )))
                ->add('puntajePremio', 'integer', array(
                    'label' => 'Puntos en $',
                    'attr' => array(
                        'min' => '0',
                    'disabled' => $disableOption
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
                ->add('localComercial', null, array(
                    'disabled' => $disableOption
                ))
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
