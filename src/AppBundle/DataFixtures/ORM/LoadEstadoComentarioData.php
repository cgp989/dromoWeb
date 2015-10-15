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
use AppBundle\Entity\EstadoComentario;
/**
 * Description of LoadEstadoComentarioData
 *
 * @author CRISTIANGILBERTO
 */
class LoadEstadoComentarioData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            'estadoComentario-activado' => array(
                'nombre' => 'activado' 
            ),
            'estadoComentario-denunciado' => array(
                'nombre' => 'denunciado' 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $estadoComentario = new EstadoComentario();
            $estadoComentario->setNombre($entity['nombre']);
            $this->addReference($referenciaEntity, $estadoComentario);
            $manager->persist($estadoComentario);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 1; 
    }
}
