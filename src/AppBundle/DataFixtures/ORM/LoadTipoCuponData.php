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
use AppBundle\Entity\TipoCupon;
/**
 * Description of LoadTipoCuponData
 *
 * @author CRISTIANGILBERTO
 */
class LoadTipoCuponData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'tipoCupon-promocion' => array(
                'nombre' => 'promocion' 
            ),
            'tipoCupon-premio' => array(
                'nombre' => 'premio' 
            )
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $tipoCupon = new TipoCupon();
            $tipoCupon->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $tipoCupon);
            $manager->persist($tipoCupon);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
