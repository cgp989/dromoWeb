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
use AppBundle\Entity\EstadoProgramacionEnDia;
/**
 * Description of LoadEstadoProgramacionEnDiaData
 *
 * @author CRISTIANGILBERTO
 */
class LoadEstadoProgramacionEnDiaData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'estadoProgramacionEnDia-activada' => array(
                'nombre' => 'activada' 
            ),
            'estadoProgramacionEnDia-desactivada' => array(
                'nombre' => 'desactivada' 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $estadoProgramacionEnDia = new EstadoProgramacionEnDia();
            $estadoProgramacionEnDia->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $estadoProgramacionEnDia);
            $manager->persist($estadoProgramacionEnDia);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
