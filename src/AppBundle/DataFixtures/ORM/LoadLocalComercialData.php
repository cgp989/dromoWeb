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
        $arrayLocalComercial = array(
            'localComercial-mostachys' => array(
                'nombre' => 'Mostachys',
                'descripcion' => 'Descripcion del comedor mostachys',
                'emailContacto' => 'mostachys@mostachys.com',
                'nombreContacto' => 'Raul',
                'telefonoContacto' => '351653453',
                'imagen' => 'mostachys.jpg',
                'logo' => 'mostachys-logo.jpg',
                'version' => 1,
                'usuario' => $this->getReference('usuario-pabloc'),
            ),
            'localComercial-laCocina' => array(
                'nombre' => 'La cocina',
                'descripcion' => 'Descripcion del comedor la cocina',
                'emailContacto' => 'lacocinacomedor@gmail.com',
                'nombreContacto' => 'Cristian',
                'telefonoContacto' => '351654453',
                'imagen' => 'laCocina.jpg',
                'logo' => 'laCocina-logo.jpg',
                'version' => 1,
                'usuario' => $this->getReference('usuario-Raul'),
            ),
        );
        
        $localComercial;
        foreach ($arrayLocalComercial as $referenciaLocal => $local) {
            $localComercial = new LocalComercial();
            $localComercial->setNombre($local['nombre']);
            $localComercial->setDescripcion($local['descripcion']);
            $localComercial->setEmailContacto($local['emailContacto']);
            $localComercial->setNombreContacto($local['nombreContacto']);
            $localComercial->setTelefonoContacto($local['telefonoContacto']);
            $localComercial->setImagen($local['imagen']);
            $localComercial->setLogo($local['nombreContacto']);
            $localComercial->setVersion($local['version']);
            $localComercial->setUsuario($local['usuario']);
            $this->addReference($referenciaLocal, $localComercial);
            $manager->persist($localComercial);
        }
        
        
        
        $manager->flush();
    }
    
    public function getOrder(){
        return 4; 
    }
}
