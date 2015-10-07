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
use AppBundle\Entity\EstadoPromocion;
/**
 * Description of LoadEstadoPromocionData
 *
 * @author CRISTIANGILBERTO
 */
class LoadEstadoPromocionData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'estadoPromocion-activada' => array(
                'nombre' => 'activada' 
            ),
            'estadoPromocion-desactivada' => array(
                'nombre' => 'desactivada' 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $estadoPromocion = new EstadoPromocion();
            $estadoPromocion->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $estadoPromocion);
            $manager->persist($estadoPromocion);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
