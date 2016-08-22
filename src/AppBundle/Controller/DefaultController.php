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
            if($this->getUser()->getFirstLogin()){
//               $user = $this->getUser();
//               $user->setFirstLogin(false);
//               $em = $this->getDoctrine()->getManager()->persist($user);
//               $em = $this->getDoctrine()->getManager()->flush();
               
               //mesaje flash que se muestra en la pagina
                $this->get('session')->getFlashBag()->set(
                    'success',
                    array(
                        'title' => 'Bienvenido!',
                        'message' => 'Se recomienda cambiar su contraseña en su primer inicio de sesión.'
                    )
                );
                
               $this->get('session')->getFlashBag()->set('terminos_y_condiciones', true);
               return new RedirectResponse($this->generateUrl('fos_user_change_password'));
            }
            return new RedirectResponse($this->generateUrl('app_index_local'));
        }elseif(!is_null($this->getUser()) && $this->getUser()->hasRole('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('app_index_admin'));
        }else{
            return new RedirectResponse($this->generateUrl('fos_user_security_login'));
        }
    }
}
