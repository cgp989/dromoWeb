<?php

namespace dromo\Bundle\AppLocalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('dromoAppLocalBundle:Default:index.html.twig', array('name' => $name));
    }
}
