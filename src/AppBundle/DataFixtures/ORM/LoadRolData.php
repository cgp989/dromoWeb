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
use AppBundle\Entity\Rol;

class LoadRolData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayRoles = array(
            'rol-usuarioMovil' => array(
                'descripcion' => 'usuario movil',
            ),
            'rol-usuarioAdministrador' => array(
                'descripcion' => 'usuario administrador',
            ),
            'rol-usuarioLocalComercial' => array(
                'descripcion' => 'usuario local',
            ),
        );
        
        $rolEntity;
        foreach ($arrayRoles as $referencia => $rol) {
            $rolEntity = new Rol();
            $rolEntity->setDescripcion($rol['descripcion']);
            $manager->persist($rolEntity);
            $this->addReference($referencia, $rolEntity);
        }
        
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
