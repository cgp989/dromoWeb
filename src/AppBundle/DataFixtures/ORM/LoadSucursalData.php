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
        $arraySucursales = array(
            array(
              'direccion' => $this->getReference('direccion-mostachys-bvSanJuan'),
              'localComercial' => $this->getReference('localComercial-mostachys'),
              'telefono' => '351635432'
            ),
            array(
              'direccion' => $this->getReference('direccion-mostachys-Chacabuco1166'),
              'localComercial' => $this->getReference('localComercial-mostachys'),
              'telefono' => '351985412'
            ),
            array(
              'direccion' => $this->getReference('direccion-laCocina-independencia465'),
              'localComercial' => $this->getReference('localComercial-laCocina'),
              'telefono' => '351432423'
            ),
            array(
              'direccion' => $this->getReference('direccion-laCocina-buenosAires1160'),
              'localComercial' => $this->getReference('localComercial-laCocina'),
              'telefono' => '35123466'
            ),
        );
        
        $sucursalEntity;
        foreach ($arraySucursales as $referencia => $sucursal) {
            $sucursalEntity = new Sucursal();
            $sucursalEntity->setDireccion($sucursal['direccion']);
            $sucursalEntity->setLocalComercial($sucursal['localComercial']);
            $sucursalEntity->setTelefono($sucursal['telefono']);
            $manager->persist($sucursalEntity);
        }
        $manager->flush();
    }

    public function getOrder(){
        return 5; 
    }
}
