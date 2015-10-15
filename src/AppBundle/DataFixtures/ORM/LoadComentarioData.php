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
use AppBundle\Entity\Comentario;
/**
 * Description of LoadComentarioData
 *
 * @author CRISTIANGILBERTO
 */
class LoadComentarioData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
        $arrayEntity = array(
            array(
                'comentario' => 'muy buena la comida', 
                'fecha' => new \DateTime("now"), 
                'valoracion' => 4, 
                'estadoComentario' => $this->getReference('estadoComentario-activado'), 
                'localComercial' => $this->getReference('localComercial-mostachys'), 
                'usuarioMovil' => $this->getReference('usuarioMovil-cristian'), 
            ),
            array(
                'comentario' => 'no me gusto. la comida estaba cruda', 
                'fecha' => new \DateTime("now"), 
                'valoracion' => 1, 
                'estadoComentario' => $this->getReference('estadoComentario-activado'), 
                'localComercial' => $this->getReference('localComercial-mostachys'), 
                'usuarioMovil' => $this->getReference('usuarioMovil-rodrigo'), 
            ),
            array(
                'comentario' => 'muy lindo el local. la comida medio pelo', 
                'fecha' => new \DateTime("now"), 
                'valoracion' => 3, 
                'estadoComentario' => $this->getReference('estadoComentario-activado'), 
                'localComercial' => $this->getReference('localComercial-mostachys'), 
                'usuarioMovil' => $this->getReference('usuarioMovil-cristian'), 
            ),
        );
        
        foreach ($arrayEntity as $referenciaEntity => $entity) {
            $comentario = new Comentario();
            $comentario->setComentario($entity['comentario']);
            $comentario->setFecha($entity['fecha']);
            $comentario->setValoracion($entity['valoracion']);
            $comentario->setEstadoComentario($entity['estadoComentario']);
            $comentario->setLocalComercial($entity['localComercial']);
            $comentario->setUsuarioMovil($entity['usuarioMovil']);
            $manager->persist($comentario);
        }
        $manager->flush();
    }
    
    public function getOrder(){
        return 5; 
    }
}
