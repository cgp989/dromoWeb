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
use AppBundle\Entity\LocalComercial;
/**
 * Description of LoadLocalComercialData
 *
 * @author CRISTIANGILBERTO
 */
class LoadLocalComercialData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $localComercial;
        
        $localComercial = new LocalComercial();
        $localComercial->setNombre('Mostachys');
        $localComercial->setDescripcion('Descripcion del comedor mostachys');
        $localComercial->setEmailContacto('mostachys@mostachys.com');
        $localComercial->setNombreContacto('Raul');
        $localComercial->setTelefonoContacto('351653453');
        $localComercial->setImagen('mostachys.jpg');
        $localComercial->setLogo('mostachys-logo.jpg');
        $localComercial->setVersion(1);
        $this->addReference('localComercial-mostachys', $localComercial);
        $manager->persist($localComercial);
        
        $manager->flush();
    }
    
    public function getOrder(){
        return 4; 
    }
}
