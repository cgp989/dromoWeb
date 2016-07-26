<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity;

class ComentariosRestController extends Controller {

    /**
     * 
     * @param integer $idLocalComercial
     * @param integer $idUSuarioMovil
     * @param integer $nroPagina
     * 
     * @View(serializerGroups={"serviceUSS23-comentarios"})
     */
    public function getId_local_comercialId_usuario_movilNro_paginaAction($idLocalComercial, $idUSuarioMovil, $nroPagina) {
        $cantidadPorPagina = 10000;
        /* @var $localComercial Entity\LocalComercial */
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);

        if (!$this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUSuarioMovil)) {
            $error = array('codigo' => '3',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        } elseif (!is_object($localComercial)) {
            $error = array('idLocalComercial' => $idLocalComercial, 'codigo' => '5',
                'mensaje' => 'El local comercial no existe',
                'descripcion' => 'El id del local comercial no existe en la base de datos');
        } elseif ($localComercial->getComentarios()->isEmpty()) {
            $error = array('idLocalComercial' => $idLocalComercial, 'codigo' => '6',
                'mensaje' => 'No existen comentarios para este local',
                'descripcion' => 'El local comercial no contiene comentarios');
        } else {
            $inicio = $cantidadPorPagina * ($nroPagina - 1);
            $comentariosOrdenados = $localComercial->getComentariosOrdenados();
            $arrayComentarios = array_slice($comentariosOrdenados, $inicio, $cantidadPorPagina);
        }

        if (isset($error)) {
            return array('error' => $error);
        } elseif (is_array($arrayComentarios)) {
            return array("comentarios" => $arrayComentarios);
        }
    }

    /**
     * @param integer $idUSuarioMovil
     * @param integer $idLocalComercial
     * @param integer $valoracion
     * @param String $comentario
     * 
     * @View(serializerGroups={"serviceUSS31-comentarios"})
     */
    public function getId_local_comercialId_usuario_movilValoracionComentarioAction($idLocalComercial, $idUsuarioMovil, $valoracion, $comentario) {
        /* @var $localComercial Entity\LocalComercial */
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);
        /* @var $usuarioMovil Entity\UsuarioMovil */
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->find($idUsuarioMovil);

        if (!$this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuarioMovil)) {
            $error = array('codigo' => '3',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        } elseif (!is_object($localComercial)) {
            $error = array('idLocalComercial' => $idLocalComercial, 'codigo' => '5',
                'mensaje' => 'El local comercial no existe',
                'descripcion' => 'El id del local comercial no existe en la base de datos');
        } else {
            /* @var $comen Entity\Comentario */
            $comen = new Entity\Comentario();
            $em = $this->getDoctrine()->getManager();
            $comenDecode = urldecode($comentario);
            $comentario = str_replace('€', '.', $comenDecode);
            $comen->setComentario($comentario);
            $comen->setValoracion($valoracion);
            $comen->setLocalComercial($localComercial);
            $comen->setUsuarioMovil($usuarioMovil);
            $hoy = new \DateTime();
            $comen->setFecha($hoy);
            $estadoComentario = $this->getDoctrine()->getRepository('AppBundle:EstadoComentario')->find(1);
            $comen->setEstadoComentario($estadoComentario);
            $em->persist($comen);
            $em->flush();
            $comentariosLocal = $this->getDoctrine()->getRepository('AppBundle:Comentario')->findByLocalComercial($localComercial);
            $suma = 0;
            $cant = 0;
            foreach ($comentariosLocal as $coment) {
                $cant++;
                $suma+= $coment->getValoracion();
            }
            if ($cant == 0) {
                $localComercial->setValoracion(0);
                //$em->persist($localComercial);
            } else {
                $localComercial->setValoracion((double) $suma / $cant);
                //$em->persist($localComercial);
            }

            $em->flush();
        }
        if (isset($error)) {
            return array('error' => $error);
        } else {
            return array("resultado" => 1, "idLocalComercial" => $idLocalComercial);
        }
    }

}
