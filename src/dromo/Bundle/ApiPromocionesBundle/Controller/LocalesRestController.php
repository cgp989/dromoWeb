<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use APPBundle\Entity\VisitaLocalComercial;
use AppBundle\Entity;

class LocalesRestController extends Controller {

    /**
     * 
     * @param integer $idLocalComercial
     * @param integer $idUsuarioMovil
     * @View(serializerGroups={"serviceUSS23"})
     */
    public function getId_local_comercialId_usuario_movilAction($idLocalComercial, $idUsuarioMovil) {
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);
        if (!$this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuarioMovil)) {
            $error[] = array('codigo' => '',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        } elseif (!is_object($localComercial)) {
            $error[] = array('codigo' => '',
                'mensaje' => 'El local comercial no existe',
                'descripcion' => 'El id del local comercial no existe');
        }

        if (isset($error)) {
            return array('error' => $error);
        } elseif (isset($localComercial)) {
            return array("localComercial" => $localComercial);
        }
    }

    /**
     * 
     * @param integer $idLocalComercial
     * @param integer $idUsuarioMovil
     * @param booleam $suscripcion
     * @param booleam $notificacion
     */
    public function getId_local_comercialId_usuario_movilSuscripcionNotificacionAction($idLocalComercial, $idUsuarioMovil, $suscripcion, $notificacion) {
        $notificacion = filter_var($notificacion, FILTER_VALIDATE_BOOLEAN);
        $suscripcion = filter_var($suscripcion, FILTER_VALIDATE_BOOLEAN);
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->find($idUsuarioMovil);
        if (!is_object($usuarioMovil)) {
            $error[] = array('codigo' => '',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        } elseif (!is_object($localComercial)) {
            $error[] = array('codigo' => '',
                'mensaje' => 'El local comercial no existe',
                'descripcion' => 'El id del local comercial no existe');
        }
        $suscripcionEntity = $this->getDoctrine()->getRepository('AppBundle:Suscripcion')->findOneBy(
                array('localComercial' => $localComercial, 'usuarioMovil' => $usuarioMovil));
        if ($suscripcion) {
            if (!is_object($suscripcionEntity)) {
                $suscripcionEntity = new \AppBundle\Entity\Suscripcion();
                $suscripcionEntity->setLocalComercial($localComercial);
                $suscripcionEntity->setUsuarioMovil($usuarioMovil);
                $suscripcionEntity->setNotificaciones((boolean) $notificacion);
            } else {
                $suscripcionEntity->setNotificaciones((boolean) $notificacion);
            }
            $this->getDoctrine()->getManager()->persist($suscripcionEntity);
        } else {
            if (is_object($suscripcionEntity)) {
                $this->getDoctrine()->getManager()->remove($suscripcionEntity);
            } else {
                $error[] = array('codigo' => '',
                    'mensaje' => 'La suscripcion no existe',
                    'descripcion' => 'No existe una suscripcion con el id del local y el id del usuario');
            }
        }

        if (isset($error)) {
            return array('error' => $error);
        } else {
            $this->getDoctrine()->getManager()->flush();
            return true;
        }
    }

    /**
     * 
     * @param String $idUsuario
     * @param String $idLocalComercial
     * 
     * 
     * @View(serializerGroups={"serviceUSS96-visita"})
     */
    public function getId_usuario_movilId_local_comercialAction($idUsuario, $idLocalComercial) {
        /* @var $usuarioMovil Entity\UsuarioMovil */
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->find($idUsuario);
        /* @var $localComercial Entity\LocalComercial */
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);

        if ($usuarioMovil == null || $localComercial == null) {
            $error[] = array('codigo' => '',
                'mensaje' => 'Error',
                'descripcion' => 'Usuario o local inexistentes!');
        } else {

            /* @var $visitaLocalComercial Entity\VisitaLocalComercial */
            $visitaLocalComercial = new Entity\VisitaLocalComercial();
            $em = $this->getDoctrine()->getManager();
            $visitaLocalComercial->setLocalComercial($localComercial);
            $visitaLocalComercial->setUsuarioMovil($usuarioMovil);
            $hoy = new \DateTime();
            $visitaLocalComercial->setFecha($hoy);
            $em->persist($visitaLocalComercial);
            $em->flush();
        }
        if (isset($error)) {
            return false;
        } else {
            return true;
        }
    }

}
