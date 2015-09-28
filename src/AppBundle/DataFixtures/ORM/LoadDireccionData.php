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
use AppBundle\Entity\Direccion;

class LoadDireccionData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $localidadCordoba = $manager->find('AppBundle:Localidad', 543);
        
        $arrayDirecciones = array(
            'direccion-mostachys-bvSanJuan' => array(
                'descripcion' => 'Bv San Juan 6, Nueva Cordoba',
                'localidad' => $localidadCordoba,
                'latitud' => -31.420660,
                'longitud' => -64.186125,
            ),
            'direccion-mostachys-Chacabuco1166' => array(
                'descripcion' => 'Boulevard Chacabuco 1166',
                'localidad' => $localidadCordoba,
                'latitud' => -31.422399,
                'longitud' => -64.182692,
            ),
            'direccion-laCocina-independencia465' => array(
                'descripcion' => 'Independencia 465',
                'localidad' => $localidadCordoba,
                'latitud' => -31.421725,
                'longitud' => -64.186360,
            ),
            'direccion-laCocina-buenosAires1160' => array(
                'descripcion' => 'Buenos Aires 1160',
                'localidad' => $localidadCordoba,
                'latitud' => -31.429753,
                'longitud' => -64.188440,
            ),
        );
        
        $direccionEntity;
        foreach ($arrayDirecciones as $referencia => $direccion) {
            $direccionEntity = new Direccion();
            $direccionEntity->setDescripcion($direccion['descripcion']);
            $direccionEntity->setLocalidad($direccion['localidad']);
            $direccionEntity->setLatitud($direccion['latitud']);
            $direccionEntity->setLongitud($direccion['longitud']);
            $manager->persist($direccionEntity);
            $this->addReference($referencia, $direccionEntity);
        }
        
        
        $manager->flush();
        
    }
    
    public function getOrder(){
        return 3; 
    }
}
