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
class UsuariosRestController extends Controller {
    /**
     * 
     * @param String $usuario
     * @param String $password
     * 
     * 
     * @View(serializerGroups={"serviceUSS02-login"})
     */
//    public function getUsuarioPasswordAction($usuario, $password) {
//        /* @var $usuarioMovil Entity\UsuarioMovil */
//        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);
//
//        if ($usuarioMovil != null && $usuarioMovil->getPassword() != $password) {
//            $error[] = array('codigo' => '',
//                'mensaje' => 'Acceso incorrecto',
//                'descripcion' => 'Password incorrecto! Usuario valido');
//        } else {
//            if ($usuarioMovil != null) {
//                $arrayUsuario = array("usuario" => $usuarioMovil);
//            } else {
//                $error[] = array('codigo' => '',
//                    'mensaje' => 'Acceso incorrecto',
//                    'descripcion' => 'Usuario incorrecto');
//            }
//        }
//
//        if (isset($error)) {
//            return array('password' => $password, 'error' => $error);
//        } elseif (is_array($arrayUsuario)) {
//            return $arrayUsuario;
//        }
//    }

    /**
     * Login y alta d enuevo usuario
     * @param String $usuario
     * @param String $password
     * @param String $nombre
     * @param String $apellido
     * @param String $fecha
     * @param String $sexo
     * @param String $foto
     * 
     * 
     * @View(serializerGroups={"serviceUSS04-cuenta"})
     */
    public function getUsuarioPasswordNombreApellidoFechaSexoFotoAction($usuario, $password, $nombre, $apellido, $fecha, $sexo, $foto) {
        // el campo password es el id que devuelve google
        /* @var $usuarioMovil Entity\UsuarioMovil */
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByPassword($password);
        if ($usuarioMovil != null) {
            $em = $this->getDoctrine()->getManager();
            //setear datos a um
            if ($usuario != null && $usuario != "null" && $usuario != "") {
                $usuarioMovil->setUsuario($usuario);
            }
            if ($apellido != null && $apellido != "null" && $apellido != "") {
                $usuarioMovil->setApellido($apellido);
            }
            if ($nombre != null && $nombre != "null" && $nombre != "") {
                $usuarioMovil->setNombre($nombre);
            }
            if ($sexo != null && $sexo != "null" && sexo != "") {
                $usuarioMovil->setSexo($sexo);
            }
            if ($fecha != null && $fecha != "null" && fecha != "") {
                $timestamp = new \DateTime($fecha); // 1990-11-21
                $usuarioMovil->setFechaNacimiento($timestamp);
            }
            if ($foto != null && $foto != "null" && $foto != "") {
                $usuarioMovil->setFoto($foto);
            }
            $em->persist($usuarioMovil);
            $em->flush();

            $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByPassword($password);
            if ($usuarioMovil != null) {
                $arrayUsuario = array("usuario" => $usuarioMovil);
            }
        } else {
            //insertar usuario
            $usuarioMovil = new Entity\UsuarioMovil();
            $em = $this->getDoctrine()->getManager();
            //setear datos a um
            $usuarioMovil->setUsuario($usuario);
            $usuarioMovil->setPassword($password);
            $usuarioMovil->setApellido($apellido);
            $usuarioMovil->setNombre($nombre);
            $usuarioMovil->setSexo($sexo);
            if ($fecha == "") {
                $fecha = "2100-01-01";
            }
            $timestamp = new \DateTime($fecha);   //AAAA-MM-DD        
            $usuarioMovil->setFechaNacimiento($timestamp);
            $usuarioMovil->setFoto($foto);
            $usuarioMovil->setPuntos(0);
            $em->persist($usuarioMovil);
            $em->flush();

            $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByPassword($password);
            if ($usuarioMovil != null) {
                $arrayUsuario = array("usuario" => $usuarioMovil);
            }
        }

        if (isset($error)) {
            return array('password' => $password, 'error' => $error);
        } else {
            return $arrayUsuario;
        }
    }

    /**
     * Da de baja un UM
     * @param String $password
     * 
     * 
     * @View(serializerGroups={"serviceUSS04-cuenta"})
     */
    public function getPasswordAction($password) {
        // el campo password es el id que devuelve google
        /* @var $usuarioMovil Entity\UsuarioMovil */
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByPassword($password);
        if ($usuarioMovil != null) {
            $em = $this->getDoctrine()->getManager();
            //setear datos a um
            $usuarioMovil->setPassword("XX");
            $usuarioMovil->setUsuario("XX");
            $usuarioMovil->setNombre("XX");
            $usuarioMovil->setApellido("XX");
            $comentarios = $usuarioMovil->getComentarios();
            /* @var $comentario Entity\Comentario */
            
            foreach ($comentarios as $comentario) {
                $em->remove($comentario);
            }
            $em->persist($usuarioMovil);
            $em->flush();

            $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByPassword($password);
            if ($usuarioMovil != null) {
                $arrayUsuario = array("usuario" => $usuarioMovil);
            }
        } else {
            $error[] = array('codigo' => '',
                'mensaje' => 'Error de Usuario',
                'descripcion' => 'Usuario no registrado para dar de baja');
        }
        if (isset($error)) {
            return array('password' => $password, 'error' => $error);
        } else{
            return array('password' => $password,
                'res' => 1);
        }
    }

}
