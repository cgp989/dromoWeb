<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of Ventas
 *
 * @author CRISTIANGILBERTO
 */
class VentasController extends Controller {
    /**
     * Lista todas las ventas hechas por el local logueado
     */
    public function indexAction()
    {
        $repositoryCupon = $this->getDoctrine()->getRepository('AppBundle:Cupon');
        $cupones = $repositoryCupon->getVentasLocal($this->getUser()->getId());
        
        return $this->render('AppBundle:Ventas:index.html.twig', array(
                    'cupones' => $cupones,
        ));
    }
}
