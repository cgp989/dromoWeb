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
        $Local = $repositoryLocal->findOneById($id);
        return $this->render('AppBundle:Cobros:listarPendientesLocal.html.twig', array(
            'idLocal' => $id,
            'cuponesPendientes' => $cuponesPendientes, 'nombreLocal' => $Local->getNombre(),
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
        return $this->getPendientesLocalAction($id);
    }

    /**
     * Lista los locales que tienen cobros realizados
     */
    public function showLocalesCobradosAction() {
        $repositoryLocal = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
        $locales = $repositoryLocal->getCobrados();

        return $this->render('AppBundle:Cobros:showLocalesCobrados.html.twig', array(
                    'locales' => $locales,
        ));
    }

    /**
     * Me retorna un listado de los cupones cobrados a un local
     * 
     * @param type $idLocal
     */
    public function getCobradosLocalAction($id) {
        $repositoryLocal = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
        $cuponesCobrados = $repositoryLocal->getItemsCobradosCobro($id);
        foreach ($cuponesCobrados as $e) {
            $local = $e['nombre'];
            break;
        }
        return $this->render('AppBundle:Cobros:listarCobradosLocal.html.twig', array(
                    'cuponesCobrados' => $cuponesCobrados, 'nombreLocal' => $local,
        ));
    }
    
    public function getPdfPendientesLocalAction($id){
        $repositoryLocal = $this->getDoctrine()->getRepository('AppBundle:LocalComercial');
        $cuponesPendientes = $repositoryLocal->getItemsPendientesCobro($id);
        $Local = $repositoryLocal->findOneById($id);
        $html = $this->render('AppBundle:Cobros:listarPendientesLocalPdf.html.twig', array(
            'cuponesPendientes' => $cuponesPendientes, 'nombreLocal' => $Local->getNombre(),
        ));
        return new Response(
           $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
           200,
           [
               'Content-Type'        => 'application/pdf',
               'Content-Disposition' => sprintf('attachment; filename="%s"', 'cobros-pendientes-local'),
           ]
        );
    }
}
