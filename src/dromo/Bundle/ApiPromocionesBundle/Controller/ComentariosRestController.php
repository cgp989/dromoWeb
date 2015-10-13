<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

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
        
    }
}
