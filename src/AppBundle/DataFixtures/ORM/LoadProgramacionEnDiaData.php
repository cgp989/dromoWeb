<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadDireccionData
 *
 * @author CRISTIANGILBERTO
 */
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ProgramacionEnDia;

class LoadProgramacionEnDiaData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            array(
                'cantidadDisponible' => '10',
                'validez' => '9:00 - 12:00',
                'estadoProgramacionEndia' => $this->getReference('estadoProgramacionEnDia-activada'),
                'programacion' => $this->getReference('programacion-2x1-lomito-mostachys'),
            ),
            array(
                'cantidadDisponible' => '15',
                'validez' => '9:00 - 12:00',
                'estadoProgramacionEndia' => $this->getReference('estadoProgramacionEnDia-activada'),
                'programacion' => $this->getReference('programacion-3x2-lomito-mostachys'),
            ),
            array(
                'cantidadDisponible' => '40',
                'validez' => '10:00 - 15:00',
                'estadoProgramacionEndia' => $this->getReference('estadoProgramacionEnDia-activada'),
                'programacion' => $this->getReference('programacion-50%-milanesas-laCocina'),
            ),
            array(
                'cantidadDisponible' => '40',
                'validez' => '10:00 - 16:00',
                'estadoProgramacionEndia' => $this->getReference('estadoProgramacionEnDia-activada'),
                'programacion' => $this->getReference('programacion-30%-pastas-laCocina'),
            ),
        );
        
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $programacionEnDia = new ProgramacionEnDia();
            $programacionEnDia->setCantidadDisponible($entity['cantidadDisponible']);
            $programacionEnDia->setValidez($entity['validez']);
            $programacionEnDia->setEstadoProgramacionEnDia($entity['estadoProgramacionEndia']);
            $programacionEnDia->setProgramacion($entity['programacion']);
            $this->addReference($referenciaEntity, $programacionEnDia);
            $manager->persist($programacionEnDia);
        }
        $manager->flush();
        
    }
    
    public function getOrder(){
        return 7; 
    }
}
