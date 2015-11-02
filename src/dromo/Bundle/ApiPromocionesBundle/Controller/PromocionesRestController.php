<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use JeroenDesloovere\Distance\Distance;
use AppBundle\Entity\ProgramacionEnDia;
class PromocionesRestController extends Controller
{
    /**
     * 
     * @param decimal $latitud
     * @param decimal $longitud
     * @param integer $idUsuario
     * @param integer $nroPagina
     * 
     * @View(serializerGroups={"serviceUSS013"})
     */
    public function getLatitudLongitudIdusaurioNropaginaAction($latitud, $longitud, $idUsuario, $nroPagina){
        $cantidadPorPagina = 20;
        $error;
        if($this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuario)){
            
            $repositoryProgramacion = $this->getDoctrine()->getRepository('AppBundle:ProgramacionEnDia');
            $programaciones = $repositoryProgramacion->findAll();
            
            foreach ($programaciones as $programacion) {
                $localComercial = $programacion -> 
                                    getProgramacion() -> 
                                        getPromocion() -> 
                                            getLocalComercial();
                $distance = $localComercial -> getSucursalMinimaDistancia($latitud, $longitud);
                $programacion->setDistanciaALocalComercial($distance['distance']);
                $programacion->setSucursalMasCercana($distance['title']);
            }
            
            $repositoryProgramacion->ordenarPorDistanciaALocal($programaciones);
            
            $inicio = $cantidadPorPagina * ($nroPagina -1);
            $arrayPaginaPromociones = array_slice ($programaciones, $inicio, $cantidadPorPagina);
        }else{
            $error[] = array('codigo' => '',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        }
        
        if (!isset($error)) {
            return array('promociones' => $arrayPaginaPromociones);
        } else
            return array('error' => $error);
    }
    
    /**
     * 
     * @param integer $idProgramacion
     * @param integer $idUsuario
     * @View(serializerGroups={"serviceUSS21"})
     */
    public function getId_programacionId_usuario_movilAction($idProgramacion , $idUsuarioMovil){
        $repositoryProgramacionEnDia = $this->getDoctrine()->getRepository('AppBundle:ProgramacionEnDia');
        $repositoryUsuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil');
        $repositoryCupon = $this->getDoctrine()->getRepository('AppBundle:Cupon');
        /* @var $programacionEnDia ProgramacionEnDia */
        $programacionEnDia = $repositoryProgramacionEnDia->findByIdProgramacion($idProgramacion);
        $usuarioMovil = $repositoryUsuarioMovil->findOneById($idUsuarioMovil);

        if (is_null($programacionEnDia)){
            $error[] = array('codigo' => '',
                'mensaje' => 'La programacion no existe',
                'descripcion' => 'El id de la programacion en dia no existe');
        } elseif ($programacionEnDia->getEstadoProgramacionEnDia()->getNombre() == 'agotada') {
            $error[] = array('codigo' => '',
                'mensaje' => 'La programacion se agoto',
                'descripcion' => 'el estado de la programacion es agotada');
        } elseif ($programacionEnDia->getEstadoProgramacionEnDia()->getNombre() == 'noVigente') {
            $error[] = array('codigo' => '',
                'mensaje' => 'La programacion aun no esta vigente',
                'descripcion' => 'el estado de la programacion no es noVigente');
        } elseif (!is_object($usuarioMovil)){
            $error[] = array('codigo' => '',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario movil no existe');
        } else {
            //INICIO TRANSACCION
           $this->getDoctrine()->getConnection()->beginTransaction();

           try {
               $nuevoCupon = $repositoryCupon->crearNuevoCupon($programacionEnDia, $usuarioMovil);
               $repositoryProgramacionEnDia->descontarCantidadDisponible($programacionEnDia);
               //FINALIZO TRANSACCION
               $this->getDoctrine()->getConnection()->commit();

           } catch (Exception $e) {
               //VUELVO CAMBIOS ATRAS 
               $this->getDoctrine()->getConnection()->rollback();
               $error[] = array('codigo' => '',
                       'mensaje' => 'Ocurrio un error al crear el nuevo cupon',
                       'descripcion' => 'fallo alguna de las consutlas a la base de datos y se lanzo una excepcion');
           }
        }
        
        if(isset($error)){
            return array('error' => $error);
        }elseif (isset ($nuevoCupon)) {
            return array("cupon" => $nuevoCupon);
        }
    }
}
