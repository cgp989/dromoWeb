<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
class PromocionesRestController extends Controller
{
    /**
     * 
     */
    public function getLatitudLongitudIdusaurioNropaginaAction($latitud, $longitud, $idUsuario, $nroPagina){
        if($this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuario)){
            $repository = $this->getDoctrine()
                        ->getRepository('AppBundle:PromocionEnDia');
            // obtiene todas las promociones
            $promociones = $repository->findAll();
            return $promociones;
        }else{
            return array('error' => 'no existe el usuario');
        }
    }
}
