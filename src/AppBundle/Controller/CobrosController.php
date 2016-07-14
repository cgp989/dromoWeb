<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\EstadoCobroCupon;

/**
 * Description of CobrosController
 *
 * @author CRISTIANGILBERTO
 */
class CobrosController extends Controller {

    /**
     * Lista los locales que tienen cobros pendientes
     */
    public function showLocalesPendientesAction() {
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
    public function getPendientesLocalAction($id) {
        //PABLO ACA TENES QUE HACER LA CONSULTA QUE TRAIGA LOS CUPONES PENDIENTES DE UN LOCAL. 
        //HACELO ADENTRO DEL REPOSITORIO DE CUPON O DE LOCAL
        $repositoryLocal = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
        $cuponesPendientes = $repositoryLocal->getItemsPendientesCobro($id);
        return $this->render('AppBundle:Cobros:listarPendientesLocal.html.twig', array(
                    'cuponesPendientes' => $cuponesPendientes,
        ));
    }

    /**
     * Setea estado "cobrado" de cupon y recarga pagina de pendientes de cobrar
     * 
     * @param type $id
     * @param type $idCupon
     */
    public function setCobroLocalAction($id, $idCupon) {
        //setear estado "cobrado"
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Cupon')->find($idCupon);
        $estadoCobrado = $em->getRepository('AppBundle:EstadoCobroCupon')->findOneByNombre('cobrado');
        $entity->setEstadoCobroCupon($estadoCobrado);
        $em->persist($entity);
        $em->flush();
        //redirigir
        $repositoryLocal = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
        $cuponesPendientes = $repositoryLocal->getItemsPendientesCobro($id);
        return $this->render('AppBundle:Cobros:listarPendientesLocal.html.twig', array(
                    'cuponesPendientes' => $cuponesPendientes,
        ));
    }

}
