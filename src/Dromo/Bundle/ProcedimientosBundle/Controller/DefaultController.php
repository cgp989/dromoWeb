<?php

namespace Dromo\Bundle\ProcedimientosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DromoProcedimientosBundle:Default:index.html.twig', array('name' => $name));
    }
}
