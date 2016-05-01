<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;

use AppBundle\Form\ConsultarCuponType;
use AppBundle\Entity\Cupon;
use AppBundle\Entity\CuponRepository;
/**
 * Description of CuponController
 *
 * @author CRISTIANGILBERTO
 */
class CuponController extends Controller {
    
    /**
     * formulario que permite la carga de un codigo de cupon para validar si existe y esta disponible
     */
    public function consultarAction(){
        $form   = $this->createConsultarForm();

        return $this->render('AppBundle:Cupon:consultar.html.twig', array(
            'consultar_form'   => $form->createView(),
        ));
    }
    
    /**
     * Crea un formulario que permite cargar el codigo de un cupon
     * 
     * @return \Symfony\Component\Form\Form The form
     */
    private function createConsultarForm()
    {
        $form = $this->createForm(new ConsultarCuponType(), null, array(
            'action' => $this->generateUrl('cupon_buscar'),
            'method' => 'POST',
        ));

        $form->add('buscar', 'submit', array('label' => 'Buscar', 'attr' => ['class' => 'btn btn-primary']));
        return $form;
    }
    
    /**
     * Busca el codigo de un cupon y si existe controla que este en fecha y que sea de el local que consulta
     */
    public function buscarAction(Request $request){
        $form = $this->createConsultarForm();
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $dataForm = $form->getData();
            $codigoCupon = $dataForm['codigo'];
            $em = $this->getDoctrine()->getManager();
            $repositoryCupon = $em->getRepository('AppBundle:Cupon');
            /* @var $cupon \AppBundle\Entity\Cupon */
            $cupon = $repositoryCupon->findOneByCodigo($codigoCupon);
        if(!is_null($cupon)){
                $idLocal = $cupon->getProgramacion()->getPromocion()->getLocalComercial()->getId();
                if($this->getUser()->getLocalComercial()->getId() == $idLocal){
                    //ACA LLAMO A LA FUNCION QUE MUESTRA LA INDORMACION DEL CUPON Y EL BOTON PARA CANJEAR
                }else{
                    $form->addError(new FormError('El cup&oacute;n no es de este local'));
                }
            }else{
                $form->addError(new FormError('El codigo no existe'));
            }
        }
        
        return $this->render('AppBundle:Cupon:consultar.html.twig', array(
            'consultar_form'   => $form->createView(),
            ));
    }
}
