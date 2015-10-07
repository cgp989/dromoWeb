<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Programacion;
/**
 * Description of LoadProgramacionData
 *
 * @author CRISTIANGILBERTO
 */
class LoadProgramacionData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'programacion-2x1-lomito-mostachys' => array(
                'descripcion' => 'descripcion de programacion',
                'duracion' => 3, 
                'fechaInicio' => new \DateTime('2015-10-07'), 
                'fechaFin' => new \DateTime('2015-10-17'), 
                'horaInicio' => new \DateTime('09:00'), 
                'cantidad' => 10, 
                'esLunes' => true, 
                'esMartes' => true, 
                'esMiercoles' => true, 
                'esJueves' => true, 
                'esViernes' => false, 
                'esSabado' => false, 
                'esDomingo' => false, 
                'promocion' => $this->getReference('promocion-2x1-lomito-mostachys'), 
                'estadoProgramacion' => $this->getReference('estadoProgramacion-activada'), 
            ),
            'programacion-3x2-lomito-mostachys' => array(
                'descripcion' => 'descripcion de programacion',
                'duracion' => 3, 
                'fechaInicio' => new \DateTime('2015-10-07'), 
                'fechaFin' => new \DateTime('2015-10-17'), 
                'horaInicio' => new \DateTime('09:00'), 
                'cantidad' => 15, 
                'esLunes' => false, 
                'esMartes' => true, 
                'esMiercoles' => false, 
                'esJueves' => false, 
                'esViernes' => true, 
                'esSabado' => true, 
                'esDomingo' => true, 
                'promocion' => $this->getReference('promocion-3x2-lomito-mostachys'), 
                'estadoProgramacion' => $this->getReference('estadoProgramacion-activada'), 
            ),
            'programacion-50%-milanesas-laCocina' => array(
                'descripcion' => 'descripcion de programacion',
                'duracion' => 5, 
                'fechaInicio' => new \DateTime('2015-10-06'), 
                'fechaFin' => new \DateTime('2015-10-15'), 
                'horaInicio' => new \DateTime('10:00'), 
                'cantidad' => 40, 
                'esLunes' => false, 
                'esMartes' => true, 
                'esMiercoles' => false, 
                'esJueves' => false, 
                'esViernes' => true, 
                'esSabado' => true, 
                'esDomingo' => true, 
                'promocion' => $this->getReference('promocion-50%-milanesas-laCocina'), 
                'estadoProgramacion' => $this->getReference('estadoProgramacion-activada'), 
            ),
            'programacion-30%-pastas-laCocina' => array(
                'descripcion' => 'descripcion de programacion',
                'duracion' => 6, 
                'fechaInicio' => new \DateTime('2015-10-06'), 
                'fechaFin' => new \DateTime('2015-10-15'), 
                'horaInicio' => new \DateTime('10:00'), 
                'cantidad' => 40, 
                'esLunes' => false, 
                'esMartes' => true, 
                'esMiercoles' => false, 
                'esJueves' => false, 
                'esViernes' => true, 
                'esSabado' => true, 
                'esDomingo' => true, 
                'promocion' => $this->getReference('promocion-30%-pastas-laCocina'), 
                'estadoProgramacion' => $this->getReference('estadoProgramacion-activada'), 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $programacion = new Programacion();
            $programacion->setDescripcion($entity['descripcion']);
            $programacion->setDuracion($entity['duracion']);
            $programacion->setFechaInicio($entity['fechaInicio']);
            $programacion->setFechaFin($entity['fechaFin']);
            $programacion->setHoraInicio($entity['horaInicio']);
            $programacion->setCantidad($entity['cantidad']);
            $programacion->setEsLunes($entity['esLunes']);
            $programacion->setEsMartes($entity['esMartes']);
            $programacion->setEsMiercoles($entity['esMiercoles']);
            $programacion->setEsJueves($entity['esJueves']);
            $programacion->setEsViernes($entity['esViernes']);
            $programacion->setEsSabado($entity['esSabado']);
            $programacion->setEsDomingo($entity['esDomingo']);
            $programacion->setPromocion($entity['promocion']);
            $programacion->setEstadoProgramacion($entity['estadoProgramacion']);
            $this->addReference($referenciaEntity, $programacion);
            $manager->persist($programacion);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 6; 
    }
}
