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
use AppBundle\Entity\TipoPromocion;
/**
 * Description of LoadTipoPromocionData
 *
 * @author CRISTIANGILBERTO
 */
class LoadTipoPromocionData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'tipoPromocion-2x1' => array(
                'nombre' => '2x1' 
            ),
            'tipoPromocion-3x2' => array(
                'nombre' => '3x2' 
            ),
            'tipoPromocion-10%' => array(
                'nombre' => '10%' 
            ),
            'tipoPromocion-20%' => array(
                'nombre' => '20%' 
            ),
            'tipoPromocion-30%' => array(
                'nombre' => '30%' 
            ),
            'tipoPromocion-40%' => array(
                'nombre' => '40%' 
            ),
            'tipoPromocion-50%' => array(
                'nombre' => '50%' 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $tipoPromocion = new TipoPromocion();
            $tipoPromocion->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $tipoPromocion);
            $manager->persist($tipoPromocion);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
