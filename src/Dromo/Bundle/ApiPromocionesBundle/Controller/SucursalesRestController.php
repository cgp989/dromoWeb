<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\LocalComercial;

class SucursalesRestController extends Controller {

    /**
     * 
     * @param integer $idLocalComercial
     * @param integer $idUsuarioMovil
     * @param decimal $latitud
     * @param decimal $longitud
     * 
     * @View(serializerGroups={"serviceUSS013-sucursales"})
     */
    public function getLatitudLongitudId_local_comercialId_usuario_movilAction($latitud, $longitud, $idLocalComercial, $idUsuarioMovil) {

        /* @var $localComercial LocalComercial */
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);
        if (!$this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuarioMovil)) {
            $error = array('codigo' => '3',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        } elseif (!is_object($localComercial)) {
            $error = array('idLocalComercial' => $idLocalComercial, 'codigo' => '5',
                'mensaje' => 'El local comercial no existe',
                'descripcion' => 'El id del local comercial no existe en la base de datos');
        } else {
            $arraySucursalesOrdenadas = $this->getDoctrine()->getRepository('AppBundle:Sucursal')
                    ->getListSucursalesPorDistancia($localComercial->getSucursales()->getValues(), $latitud, $longitud);
        }

        if (isset($error)) {
            return array('error' => $error);
        } elseif (isset($arraySucursalesOrdenadas)) {
            return array("sucursales" => array_values($arraySucursalesOrdenadas));
        }
    }

}
