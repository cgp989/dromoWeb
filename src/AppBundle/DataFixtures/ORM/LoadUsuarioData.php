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
use AppBundle\Entity\Usuario;

class LoadUsuarioData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayUsuarios = array(
            'usuario-cgp989' => array(
                'usuario' => 'cgp989',
                'password' => '123456789',
                'rol' => $this->getReference('rol-usuarioMovil'),
            ),
            'usuario-rodrisas' => array(
                'usuario' => 'rodrisas',
                'password' => 'rodri',
                'rol' => $this->getReference('rol-usuarioMovil'),
            ),
            'usuario-davidzurbrigen' => array(
                'usuario' => 'davidzurbrigen',
                'password' => 'david',
                'rol' => $this->getReference('rol-usuarioAdministrador'),
            ),
            'usuario-pabloc' => array(
                'usuario' => 'pabloc',
                'password' => 'pablito',
                'rol' => $this->getReference('rol-usuarioLocalComercial'),
            ),
            'usuario-Raul' => array(
                'usuario' => 'raulito',
                'password' => 'raulito',
                'rol' => $this->getReference('rol-usuarioLocalComercial'),
            ),
        );
        
        $usuarioEntity;
        foreach ($arrayUsuarios as $referencia => $usuario) {
            $usuarioEntity = new Usuario();
            $usuarioEntity->setUsuario($usuario['usuario']);
            $usuarioEntity->setPassword($usuario['password']);
            $usuarioEntity->setRol($usuario['rol']);
            $manager->persist($usuarioEntity);
            $this->addReference($referencia, $usuarioEntity);
        }
        
        
        $manager->flush();
        
    }
    
    public function getOrder(){
        return 2; 
    }
}
