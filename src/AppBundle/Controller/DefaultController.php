<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        if(!is_null($this->getUser()) && $this->getUser()->hasRole('ROLE_LOCAL')){
            return new RedirectResponse($this->generateUrl('app_index_local'));
        }elseif(!is_null($this->getUser()) && $this->getUser()->hasRole('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('app_index_admin'));
        }else{
            return new RedirectResponse($this->generateUrl('fos_user_security_login'));
        }
    }
}
