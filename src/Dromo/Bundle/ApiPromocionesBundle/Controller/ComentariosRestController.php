<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity;
class ComentariosRestController extends Controller
{
    /**
     * 
     * @param integer $idLocalComercial
     * @param integer $idUSuarioMovil
     * @param integer $nroPagina
     * 
     * @View(serializerGroups={"serviceUSS23-comentarios"})
     */
    public function getId_local_comercialId_usuario_movilNro_paginaAction($idLocalComercial, $idUSuarioMovil, $nroPagina){
       $cantidadPorPagina = 5;
        /* @var $localComercial Entity\LocalComercial */
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);
        
        if(!$this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUSuarioMovil)){
            $error[] = array('codigo' => '',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        }elseif(!is_object($localComercial)){
            $error[] = array('codigo' => '',
                'mensaje' => 'El local comercial no existe',
                'descripcion' => 'El id del local comercial no existe en la base de datos');
        }elseif($localComercial->getComentarios()->isEmpty()){
            $error[] = array('codigo' => '',
                'mensaje' => 'No existen comentarios para este local',
                'descripcion' => 'El local comercial no contiene comentarios');
        }else{
            $cantComentarios = $localComercial->getComentarios()->count();
            $inicio = $cantidadPorPagina*($nroPagina-1);
            $arrayComentarios = array_slice ($localComercial->getComentarios()->toArray(), $inicio, $cantidadPorPagina);
        }
        
        if(isset($error)){
            return array('error' => $error);
        }elseif(is_array($arrayComentarios)){
            return array("comentarios" => $arrayComentarios);
        }
    }
}
