<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class LocalesRestController extends Controller
{
    /**
     * 
     * @param integer $idLocalComercial
     * @param integer $idUsuarioMovil
     * @View(serializerGroups={"serviceUSS23"})
     */
    public function getId_local_comercialId_usuario_movilAction($idLocalComercial, $idUsuarioMovil){
        $localComercial = $this->getDoctrine()->getRepository('AppBundle:LocalComercial')->find($idLocalComercial);
        if(!$this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuarioMovil)){
            $error[] = array('codigo' => '',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        }elseif(!is_object($localComercial)){
            $error[] = array('codigo' => '',
                'mensaje' => 'El local comercial no existe',
                'descripcion' => 'El id del local comercial no existe');
        }
        
        if(isset($error)){
            return $error;
        }elseif (isset ($localComercial)) {
            return array("localComercial" => $localComercial);
        }
    }
}
