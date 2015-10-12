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
use AppBundle\Entity\EstadoCupon;
/**
 * Description of LoadEstadoCuponData
 *
 * @author CRISTIANGILBERTO
 */
class LoadEstadoCuponData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'estadoCupon-pendiente' => array(
                'nombre' => 'porCanjear' 
            ),
            'estadoCupon-validado' => array(
                'nombre' => 'canjeado' 
            ),
            'estadoCupon-cobrado' => array(
                'nombre' => 'vencido' 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $estadoCupon = new EstadoCupon();
            $estadoCupon->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $estadoCupon);
            $manager->persist($estadoCupon);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
