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
            'action' => $this->generateUrl('cupon_view'),
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
                    $arrayItemsView = array();
                    $arrayItemsView['cupon'] = $cupon;
                    $arrayItemsView['form_canjear'] = null;
                    $fechaHoy = new \DateTime('now');
                    if($cupon->esCuponEnfecha()){ 
                        $formCanjear = $this->createCanjearForm($cupon->getId());
                        $arrayItemsView['form_canjear'] = $formCanjear->createView();
                    }
                    
                    return $this->render('AppBundle:Cupon:view.html.twig', $arrayItemsView);
                }else{
                    $form->addError(new FormError('El cupón no es de este local'));
                }
            }else{
                $form->addError(new FormError('El codigo no existe'));
            }
        }
        
        return $this->render('AppBundle:Cupon:consultar.html.twig', array(
            'consultar_form'   => $form->createView(),
            ));
    }
    
    /**
     * Crea un formulario que permite cargar el codigo de un cupon
     * 
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCanjearForm($idCupon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cupon_exchange', array('id' => $idCupon)))
            ->setMethod('PUT')
            ->add('canjear', 'submit', 
                    array('label' => 'Canjear',
                        'attr' => 
                            ['class' => 'btn btn-primary', 
                            'onclick' => 'return confirm("¿Esta seguro de canjear este cupón?")',
                            'title' => 'canjear']
                    ))
            ->getForm()
        ;
    }
    
    /**
     * registra en la bd un cupon como canjeado actualizando su estado
     * @param integer $idCupon
     */
    public function canjearAction($id){
        $em = $this->getDoctrine()->getManager();
        $repositoryCupon = $em->getRepository('AppBundle:Cupon');
        $arrayResult = $repositoryCupon->canjearCupon($id);
        
        if($arrayResult['exito']){
            //mesaje flash que se muestra en la pagina
            $this->get('session')->getFlashBag()->set(
                'success',
                array(
                    'title' => 'Canjeado!',
                    'message' => 'El cupón se canjeó con éxito.'
                )
            );
        }else{
            //mesaje flash que se muestra en la pagina
            $this->get('session')->getFlashBag()->set(
                'warning',
                array(
                    'title' => 'Falló canje!',
                    'message' => 'Este cupón ya ha sido canjeado.'
                )
            );
        }
        return $this->render('AppBundle:Cupon:view.html.twig', array('cupon' => $arrayResult['cupon'], '', 'form_canjear' => null));
    }
}
