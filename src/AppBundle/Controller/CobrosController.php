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
use AppBundle\Entity\Cobro;
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
    public function setCobroLocalAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        
        //creo la entity cobro
        try{
            $cobroEntity = new Cobro();
            $fechaHoy = new \DateTime('now');
            $cobroEntity->setFecha($fechaHoy);
            $localEntity = $em->getRepository('AppBundle:LocalComercial')->find($request->get('idLocal'));
            $cobroEntity->setLocalComercial($localEntity);
            $cobroEntity->setTotal($request->get('total'));
            $cobroEntity->setUserAdmin($this->getUser());
            $em->persist($cobroEntity);
            $em->flush();
            //seteo a cada cupon el objeto cobro y el estado "cobrado"
            $repoCupon = $em->getRepository('AppBundle:Cupon');
            $estadoCobrado = $em->getRepository('AppBundle:EstadoCobroCupon')->findOneByNombre('cobrado');
            foreach ($request->get('cupon') as $idCupon) { 
                $cupon = $repoCupon->find($idCupon);
                $cupon->setEstadoCobroCupon($estadoCobrado);
                $cupon->setCobro($cobroEntity);
                $em->persist($cupon);
            }

            //finalizo la transaccion
            
            $em->flush();

            //mesaje flash que se muestra en la pagina
            $this->get('session')->getFlashBag()->set(
                'success',
                array(
                    'title' => 'Cobro registrado',
                    'message' => 'El cobro se registro exitosamente.'
                )
            );
            
        } catch (Exception $ex) {
            //mesaje flash que se muestra en la pagina
                        $this->get('session')->getFlashBag()->set(
                            'warning',
                            array(
                                'title' => 'Ocurrio un error',
                                'message' => 'Ocurrio un error inesperado. Vuelva a intentarlo'
                            )
            );
        }
        
        //redirijo a la pagina de cupones pendientes
        return $this->redirect($this->generateUrl('cobros_pendientes_detalle_local', array('id' => $request->get('idLocal'))));
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
        $local = $repositoryLocal->find($id);
        $repositoryCobro = $this->getDoctrine()->getRepository('AppBundle:Cobro');
        $cobrosLocal = $repositoryCobro->getCobrosLocal($id);
        return $this->render('AppBundle:Cobros:listarCobrosLocal.html.twig', array(
                    'cobros' => $cobrosLocal, 'nombreLocal' => $local->getNombre(),
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
    
    public function getDetalleCobroAction($id){
        $repositoryCobro = $this->getDoctrine()->getRepository('AppBundle:Cobro');
        $repositoryCupon = $this->getDoctrine()->getRepository('AppBundle:Cupon');
        $cobro = $repositoryCobro->find($id);
        $cuponesCobrados = $repositoryCupon->getCuponesCobro($id);
        return $this->render('AppBundle:Cobros:listarDetalleCobro.html.twig', array(
                'cuponesCobrados' => $cuponesCobrados, 'cobro' => $cobro,
        ));
    }
}
