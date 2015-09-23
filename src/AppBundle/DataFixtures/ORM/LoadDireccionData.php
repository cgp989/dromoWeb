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
        $direccion;
        $localidadCordoba = $manager->find('AppBundle:Localidad', 543);
        
        $direccion = new Direccion();
        $direccion->setDescripcion("Bv San Juan 6, Nueva Cordoba");
        $direccion->setLocalidad($localidadCordoba);
        $direccion->setLatitud(-31.420660);
        $direccion->setLongitud(-64.186125);
        $manager->persist($direccion);
        $this->addReference('direccion-mostachys-bvSanJuan', $direccion);
        
        $direccion = new Direccion();
        $direccion->setDescripcion("Boulevard Chacabuco 1166 ");
        $direccion->setLocalidad($localidadCordoba);
        $direccion->setLatitud(-31.422399);
        $direccion->setLongitud(-64.182692);
        $manager->persist($direccion);
        $this->addReference('direccion-mostachys-Chacabuco1166', $direccion);
        
        $manager->flush();
        
    }
    
    public function getOrder(){
        return 3; 
    }
}
