<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramacionPremioType extends AbstractType {

    private $opciones;

    public function __construct(array $opciones = null) {
        $this->opciones = $opciones;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        global $kernel;
        $repoPromocion = $kernel->getContainer()->get('doctrine')->getManager()->getRepository('AppBundle:Promocion');
        $builder
                ->add('fechaInicio')
                ->add('fechaFin')
                ->add('horaInicio')
                ->add('duracion', 'choice', array(
                    'choices' => array(
                        '1' => '0:30',
                        '2' => '1:00',
                        '3' => '1:30',
                        '4' => '2:00',
                        '5' => '2:30',
                        '6' => '3:00',
                        '7' => '3:30',
                        '8' => '4:00',
                        '9' => '4:30',
                        '10' => '5:00',
                        '11' => '5:30',
                        '12' => '6:00',
                        '13' => '6:30',
                        '14' => '7:00',
                        '15' => '7:30',
                        '16' => '8:00',
                        '17' => '8:30',
                        '18' => '9:00',
                        '19' => '9:30',
                        '20' => '10:00',
                        '21' => '10:30',
                        '22' => '11:00',
                        '23' => '11:30',
                        '24' => '12:00',
                        '25' => '12:30',
                        '26' => '13:00',
                        '27' => '13:30',
                        '28' => '14:00',
                        '29' => '14:30',
                        '30' => '15:00',
                        '31' => '15:30',
                        '32' => '16:00',
                        '33' => '16:30',
                        '34' => '17:00',
                        '35' => '17:30',
                        '36' => '18:00',
                        '37' => '18:30',
                        '38' => '19:00',
                        '39' => '19:30',
                        '40' => '20:00',
                        '41' => '20:30',
                        '42' => '21:00',
                        '43' => '21:30',
                        '44' => '22:00',
                        '45' => '22:30',
                        '46' => '23:00',
                        '47' => '23:30',
                        '48' => '24:00',
                    ),
                    'label' => 'Duración'
                ))
                ->add('cantidad')
                ->add('esLunes', null, array(
                    'label' => 'Lunes',
                    'required' => false
                ))
                ->add('esMartes', null, array(
                    'label' => 'Martes',
                    'required' => false
                ))
                ->add('esMiercoles', null, array(
                    'label' => 'Miercoles',
                    'required' => false
                ))
                ->add('esJueves', null, array(
                    'label' => 'Jueves',
                    'required' => false
                ))
                ->add('esViernes', null, array(
                    'label' => 'Viernes',
                    'required' => false
                ))
                ->add('esSabado', null, array(
                    'label' => 'Sabado',
                    'required' => false
                ))
                ->add('esDomingo', null, array(
                    'label' => 'Domingo',
                    'required' => false
                ))
                ->add('estadoProgramacion', null, array(
                    'class' => 'AppBundle:EstadoProgramacion',
                    'query_builder' =>
                    function (\AppBundle\Entity\EstadoProgramacionRepository $repositorio) {
                        return $repositorio->createQueryBuilder('e')
                                ->where('e.nombre != :nombreEstado')
                                ->setParameter('nombreEstado', 'eliminada');
                    },
                    'label' => 'Estado',
                    'empty_value' => null,
                    'empty_data' => null,
                ))
                ->add('descripcion', 'textarea', array(
                    'label' => 'Observaciones',
                    'required' => false
                ))
        ;
        if (isset($this->opciones['edit']) && $this->opciones['edit']) {
            $builder
                    ->add('promocion', 'entity', array(
                        'class' => 'AppBundle:Promocion',
                        'choices' => $repoPromocion->getPremios(),
                        'label' => 'Premio',
                        'empty_value' => '',
                        'attr' => array('readonly' => true))
            );
        } else {
            $builder
                    ->add('promocion', 'entity', array(
                        'class' => 'AppBundle:Promocion',
                        'choices' => $repoPromocion->getPremios(),
                        'label' => 'Premio',
                        'empty_value' => '',
                        'attr' => array('readonly' => true))
            );
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Programacion'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_programacionPremio';
    }

}
