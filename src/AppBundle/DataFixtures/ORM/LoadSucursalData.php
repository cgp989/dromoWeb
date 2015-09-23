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
use AppBundle\Entity\Sucursal;
/**
 * Description of LoadSucursalData
 *
 * @author CRISTIANGILBERTO
 */
class LoadSucursalData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $sucursal;
        
        $sucursal = new Sucursal();
        $sucursal->setDireccion($this->getReference('direccion-mostachys-bvSanJuan'));
        $sucursal->setLocalComercial($this->getReference('localComercial-mostachys'));
        $sucursal->setTelefono('351635432');
        $manager->persist($sucursal);
        
        $sucursal = new Sucursal();
        $sucursal->setDireccion($this->getReference('direccion-mostachys-Chacabuco1166'));
        $sucursal->setLocalComercial($this->getReference('localComercial-mostachys'));
        $sucursal->setTelefono('351985412');
        $manager->persist($sucursal);
        
        $manager->flush();
    }

    public function getOrder(){
        return 5; 
    }
}
