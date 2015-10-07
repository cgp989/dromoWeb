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
        $error;
        if($this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuario)){
            
            $repositoryProgramacion = $this->getDoctrine()->getRepository('AppBundle:ProgramacionEnDia');
            $programaciones = $repositoryProgramacion->findAll();
            
            //$repositoryLocalComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
            foreach ($programaciones as $programacion) {
                $localComercial = $programacion -> 
                                    getProgramacion() -> 
                                        getPromocion() -> 
                                            getLocalComercial();
                $distance = $localComercial -> getSucursalMinimaDistancia($latitud, $longitud);
                $programacion->setDistanciaALocalComercial($distance['distance']);
            }
            
            $repositoryProgramacion->ordenarPorDistanciaALocal($programaciones);
            
            $inicio = $cantidadPorPagina * ($nroPagina -1);
            $arrayPaginaPromociones = array_slice ($programaciones, $inicio, $cantidadPorPagina);
        }else{
            $error[] = array('codigo' => '',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        }
        
        if(!isset($error))
            return $arrayPaginaPromociones;
        else
            return $error;
    }
}
