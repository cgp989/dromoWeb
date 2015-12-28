<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Dromo\Bundle\ApiPromocionesBundle\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity;
/**
 * Description of UsuariosRestController
 *
 * @author Pablo
 */
class UsuariosRestController extends Controller{
     /**
     * 
     * @param String $usuario
     * @param String $password
     * 
     * 
     * @View(serializerGroups={"serviceUSS02-login"})
     */
    public function getUsuarioPasswordAction($usuario, $password){
        /* @var $usuarioMovil Entity\UsuarioMovil */
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);
        
        if($usuarioMovil !=null && $usuarioMovil->getPassword() != $password){
            $error[] = array('codigo' => '',
                'mensaje' => 'Acceso incorrecto',
                'descripcion' => 'Password incorrecto! Usuario valido');
        }else{
            if($usuarioMovil != null){
             $arrayUsuario = array("usuario" => $usuarioMovil);   
            }else{
                 $error[] = array('codigo' => '',
                'mensaje' => 'Acceso incorrecto',
                'descripcion' => 'Usuario incorrecto');
            }          
            
        }
        
        if(isset($error)){
            return array('error' => $error);
        }elseif(is_array($arrayUsuario)){
            return $arrayUsuario;
        }
    }
}
