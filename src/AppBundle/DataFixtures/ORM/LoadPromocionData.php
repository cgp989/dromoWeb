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
use AppBundle\Entity\Promocion;
/**
 * Description of LoadPromocionData
 *
 * @author CRISTIANGILBERTO
 */
class LoadPromocionData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'promocion-2x1-lomito-mostachys' => array(
                'titulo' => '2x1 en lomitos en mostachys',
                'descripcion' => '2x1 de lomitos de carne o pollo en mostachys',
                'precio' => 50.00,
                'estaModerada' => true,
                'puntajePremio' => '',
                'estadoPromocion' => $this->getReference('estadoPromocion-activada'),
                'tipoPromocion' => $this->getReference('tipoPromocion-2x1'),
                'localComercial' => $this->getReference('localComercial-mostachys')
            ),
            'promocion-3x2-lomito-mostachys' => array(
                'titulo' => '3x2 en lomitos en mostachys',
                'descripcion' => '3x2 de lomitos de carne o pollo en mostachys',
                'precio' => 100.00,
                'estaModerada' => true,
                'puntajePremio' => '',
                'estadoPromocion' => $this->getReference('estadoPromocion-activada'),
                'tipoPromocion' => $this->getReference('tipoPromocion-3x2'),
                'localComercial' => $this->getReference('localComercial-mostachys')
            ),
            'promocion-30%-pastas-laCocina' => array(
                'titulo' => '30% descuento en pastas',
                'descripcion' => '30% descuento en pastas en LA COCINA',
                'precio' => 57.00,
                'estaModerada' => true,
                'puntajePremio' => '',
                'estadoPromocion' => $this->getReference('estadoPromocion-activada'),
                'tipoPromocion' => $this->getReference('tipoPromocion-30'),
                'localComercial' => $this->getReference('localComercial-laCocina')
            ),
            'promocion-50%-milanesas-laCocina' => array(
                'titulo' => '50% descuento en milanesa',
                'descripcion' => '50% descuento en milanesas de carne en LA COCINA',
                'precio' => 25.00,
                'estaModerada' => true,
                'puntajePremio' => '',
                'estadoPromocion' => $this->getReference('estadoPromocion-activada'),
                'tipoPromocion' => $this->getReference('tipoPromocion-50'),
                'localComercial' => $this->getReference('localComercial-laCocina')
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $promocion = new Promocion();
            $promocion->setTitulo($entity['titulo']);
            $promocion->setDescripcion($entity['descripcion']);
            $promocion->setPrecio($entity['precio']);
            $promocion->setEstaModerada($entity['estaModerada']);
            $promocion->setPuntajePremio($entity['puntajePremio']);
            $promocion->setEstadoPromocion($entity['estadoPromocion']);
            $promocion->setTipoPromocion($entity['tipoPromocion']);
            $promocion->setLocalComercial($entity['localComercial']);
            $this->addReference($referenciaEntity, $promocion);
            $manager->persist($promocion);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 5; 
    }
}
