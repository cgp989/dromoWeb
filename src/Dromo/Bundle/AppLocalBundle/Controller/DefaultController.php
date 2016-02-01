<?php

namespace Dromo\Bundle\AppLocalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DromoAppLocalBundle:Default:index.html.twig');
    }
}
