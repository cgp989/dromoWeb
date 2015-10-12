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
use AppBundle\Entity\UsuarioMovil;

class LoadUsuarioMovilData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayUsuarioMovil = array(
            'usuarioMovil-cristian' => array(
                'nombre' => 'Cristian',
                'apellido' => 'Pelegrin',
                'sexo' => 'm',
                'puntos' => 15,
                'fechaNacimiento' => new \DateTime('1989-11-06'),
                'foto' => 'cristian.jpg',
                'usuario' => 'cgp989',
                'password' => '12345',
            ),
            'usuarioMovil-rodrigo' => array(
                'nombre' => 'Rodrigo',
                'apellido' => 'Sasia',
                'sexo' => 'm',
                'puntos' => 20,
                'fechaNacimiento' => new \DateTime('1991-11-04'),
                'foto' => 'rodrigo.jpg',
                'usuario' => 'rodrisas',
                'password' => 'rodri',
            ),
        );
        
        foreach ($arrayUsuarioMovil as $referencia => $usuario) {
            $usuarioMovilEntity = new UsuarioMovil();
            $usuarioMovilEntity->setNombre($usuario['nombre']);
            $usuarioMovilEntity->setApellido($usuario['apellido']);
            $usuarioMovilEntity->setSexo($usuario['sexo']);
            $usuarioMovilEntity->setPuntos($usuario['puntos']);
            $usuarioMovilEntity->setFechaNacimiento($usuario['fechaNacimiento']);
            $usuarioMovilEntity->setFoto($usuario['foto']);
            $usuarioMovilEntity->setUsuario($usuario['usuario']);
            $usuarioMovilEntity->setPassword($usuario['password']);
            $manager->persist($usuarioMovilEntity);
            $this->addReference($referencia, $usuarioMovilEntity);
        }
        
        $manager->flush();
        
    }
    
    public function getOrder(){
        return 3; 
    }
}
