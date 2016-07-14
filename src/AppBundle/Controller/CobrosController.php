<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of CobrosController
 *
 * @author CRISTIANGILBERTO
 */
class CobrosController extends Controller {
    /**
     * Lista los locales que tienen cobros pendientes
     */
    public function showLocalesPendientesAction()
    {
        $repositoryLocal = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
        $locales = $repositoryLocal->getPendientesCobro();
        
        return $this->render('AppBundle:Cobros:showLocalesPendientes.html.twig', array(
                    'locales' => $locales,
        ));
    }
    
    /**
     * Me retorna un listado de los cupones pendientes de cobro de un local
     * 
     * @param type $idLocal
     */
    public function getPendientesLocalAction($id){
        //PABLO ACA TENES QUE HACER LA CONSULTA QUE TRAIGA LOS CUPONES PENDIENTES DE UN LOCAL. 
        //HACELO ADENTRO DEL REPOSITORIO DE CUPON O DE LOCAL
        $cuponesPendientes = ''; 
        return $this->render('AppBundle:Cobros:listarPendientesLocal.html.twig', array(
                    'idLocal' => $id,
                    'cuponesPendientes' => $cuponesPendientes,
        ));
    }
    
    public function getPdfPendientesLocalAction($id){
         $html = $this->renderView('AppBundle:Cobros:pdfPromocionesPendientesCobro.html.twig');
         return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', 'nombre-del-pdf'),
            ]
        );
    }
}
