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
use AppBundle\Entity\EstadoCobroCupon;
/**
 * Description of LoadEstadoCobroCuponData
 *
 * @author CRISTIANGILBERTO
 */
class LoadEstadoCobroCuponData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'estadoCobroCupon-pendiente' => array(
                'nombre' => 'pendiente' 
            ),
            'estadoCupon-cobrado' => array(
                'nombre' => 'cobrado' 
            )
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $estadoCobroCupon = new EstadoCobroCupon();
            $estadoCobroCupon->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $estadoCobroCupon);
            $manager->persist($estadoCobroCupon);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
