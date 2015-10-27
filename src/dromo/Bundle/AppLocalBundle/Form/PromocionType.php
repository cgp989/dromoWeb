<?php

namespace dromo\Bundle\AppLocalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class PromocionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion', 'textarea')
            ->add('precio', null, array(
                'label' => 'Precio ($)'
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
            ->add('tipoPromocion', null, array(
                'label' => 'Tipo',
                'empty_value' => null,
                'empty_data' => null,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Promocion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_promocion';
    }
}
