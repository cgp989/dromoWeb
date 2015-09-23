<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use JeroenDesloovere\Distance\Distance;

class PromocionesRestController extends Controller
{
    /**
     * 
     * @param decimal $latitud
     * @param decimal $longitud
     * @param integer $idUsuario
     * @param integer $nroPagina
     */
    public function getLatitudLongitudIdusaurioNropaginaAction($latitud, $longitud, $idUsuario, $nroPagina){
        $cantidadPorPagina = 5;
        if($this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuario)){
            
            $repositoryPromocion = $this->getDoctrine()->getRepository('AppBundle:PromocionEnDia');
            $promociones = $repositoryPromocion->findAll();
            
            $repositoryLocalComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
            foreach ($promociones as $promocion) {
                $localComercial = $repositoryLocalComercial ->find($promocion -> getIdLocalComercial());
                $distance = $localComercial -> getSucursalMinimaDistancia($latitud, $longitud);
                $promocion->setDistanciaALocalComercial($distance['distance']);
            }
            
            $repositoryPromocion->ordenarPorDistanciaALocal($promociones);
            
            $inicio = $cantidadPorPagina * ($nroPagina -1);
            return array_slice ($promociones, $inicio, $cantidadPorPagina);
        }else{
            return array('error' => 'no existe el usuario');
        }
    }
}
