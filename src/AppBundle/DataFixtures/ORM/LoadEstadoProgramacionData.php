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
use AppBundle\Entity\EstadoProgramacion;
/**
 * Description of LoadEstadoProgramacionData
 *
 * @author CRISTIANGILBERTO
 */
class LoadEstadoProgramacionData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'estadoProgramacion-activada' => array(
                'nombre' => 'activada' 
            ),
            'estadoProgramacion-desactivada' => array(
                'nombre' => 'desactivada' 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $estadoProgramacion = new EstadoProgramacion();
            $estadoProgramacion->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $estadoProgramacion);
            $manager->persist($estadoProgramacion);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
