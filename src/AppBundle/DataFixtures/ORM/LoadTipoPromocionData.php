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
            'tipoPromocion-4x3' => array(
                'nombre' => '4x3' 
            ),
            'tipoPromocion-10' => array(
                'nombre' => '10' 
            ),
            'tipoPromocion-15' => array(
                'nombre' => '15' 
            ),
            'tipoPromocion-20' => array(
                'nombre' => '20' 
            ),
            'tipoPromocion-25' => array(
                'nombre' => '25' 
            ),
            'tipoPromocion-30' => array(
                'nombre' => '30' 
            ),
            'tipoPromocion-35' => array(
                'nombre' => '35' 
            ),
            'tipoPromocion-40' => array(
                'nombre' => '40' 
            ),
            'tipoPromocion-45' => array(
                'nombre' => '45' 
            ),
            'tipoPromocion-50' => array(
                'nombre' => '50' 
            ),
            'tipoPromocion-55' => array(
                'nombre' => '55' 
            ),
            'tipoPromocion-60' => array(
                'nombre' => '60' 
            ),
            'tipoPromocion-65' => array(
                'nombre' => '65' 
            ),
            'tipoPromocion-70' => array(
                'nombre' => '70' 
            ),
            'tipoPromocion-75' => array(
                'nombre' => '75' 
            ),
            'tipoPromocion-80' => array(
                'nombre' => '80' 
            ),
            'tipoPromocion-85' => array(
                'nombre' => '85' 
            ),
            'tipoPromocion-90' => array(
                'nombre' => '90' 
            ),
            'tipoPromocion-95' => array(
                'nombre' => '95' 
            ),
            'tipoPromocion-free' => array(
                'nombre' => 'free' 
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
