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
    public function getUsuarioPasswordAction($usuario, $password) {
        /* @var $usuarioMovil Entity\UsuarioMovil */
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);

        if ($usuarioMovil != null && $usuarioMovil->getPassword() != $password) {
            $error[] = array('codigo' => '',
                'mensaje' => 'Acceso incorrecto',
                'descripcion' => 'Password incorrecto! Usuario valido');
        } else {
            if ($usuarioMovil != null) {
                $arrayUsuario = array("usuario" => $usuarioMovil);
            } else {
                $error[] = array('codigo' => '',
                    'mensaje' => 'Acceso incorrecto',
                    'descripcion' => 'Usuario incorrecto');
            }
        }

        if (isset($error)) {
            return array('error' => $error);
        } elseif (is_array($arrayUsuario)) {
            return $arrayUsuario;
        }
    }

    /**
     * 
     * @param String $usuario
     * @param String $password
     * @param String $nombre
     * @param String $apellido
     * @param String $fecha
     * @param String $sexo
     * 
     * 
     * @View(serializerGroups={"serviceUSS04-cuenta"})
     */
    public function getUsuarioPasswordNombreApellidoFechaSexoTipoAction($usuario, $password, $nombre, $apellido, $fecha, $sexo, $tipo) {
        if ($tipo == "A") {
            //da de alta nuevo usuario
            /* @var $usuarioMovil Entity\UsuarioMovil */
            $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);
            if ($usuarioMovil != null) {
                $error[] = array('codigo' => '',
                    'mensaje' => 'Usuario Existente',
                    'descripcion' => 'Usuario ya registrado');
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
                $timestamp = new \DateTime($fecha);   //AAAA-MM-DD        
                $usuarioMovil->setFechaNacimiento($timestamp);
                $usuarioMovil->setFoto("");
                $usuarioMovil->setPuntos(0);
                $em->persist($usuarioMovil);
                $em->flush();

                $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);
                if ($usuarioMovil != null) {
                    $arrayUsuario = array("usuario" => $usuarioMovil);
                }
            }

            if (isset($error)) {
                return array('error' => $error);
            } elseif (is_array($arrayUsuario)) {
                return $arrayUsuario;
            }
        } else if ($tipo == "B") {
            //baja
            /* @var $usuarioMovil Entity\UsuarioMovil */
            $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);
            if ($usuarioMovil == null) {
                return false;
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->remove($usuarioMovil);
                $em->flush();
                return true;
            }
        } else if ($tipo == "M") {
            //modificar
            /* @var $usuarioMovil Entity\UsuarioMovil */
            $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);
            if ($usuarioMovil == null) {
                $error[] = array('codigo' => '',
                    'mensaje' => 'Usuario Inexistente',
                    'descripcion' => 'Usuario no registrado');
            } else {
                $em = $this->getDoctrine()->getManager();
                //setear datos a um
                if ($password != null && $password != "null") {
                    $usuarioMovil->setPassword($password);
                }
                if ($apellido != null && $apellido != "null") {
                    $usuarioMovil->setApellido($apellido);
                }
                if ($nombre != null && $nombre != "null") {
                    $usuarioMovil->setNombre($nombre);
                }
                if ($sexo != null && $sexo != "null") {
                    $usuarioMovil->setSexo($sexo);
                }
                if ($fecha != null && $fecha != "null") {
                    $timestamp = new \DateTime($fecha); // 1990-11-21
                    $usuarioMovil->setFechaNacimiento($timestamp);
                }
                $em->persist($usuarioMovil);
                $em->flush();

                $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->findOneByUsuario($usuario);
                if ($usuarioMovil != null) {
                    $arrayUsuario = array("usuario" => $usuarioMovil);
                }
            }

            if (isset($error)) {
                return array('error' => $error);
            } elseif (is_array($arrayUsuario)) {
                return $arrayUsuario;
            }
        }
    }

}
