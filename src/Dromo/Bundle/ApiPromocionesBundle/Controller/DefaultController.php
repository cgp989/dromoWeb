<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DromoApiPromocionesBundle:Default:index.html.twig', array('name' => $name));
    }
}
