<?php

namespace Dromo\Bundle\ApiPromocionesBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use JeroenDesloovere\Distance\Distance;
use AppBundle\Entity\ProgramacionEnDia;
use APPBundle\Entity\VisitaPromocion;
use APPBundle\Entity\Cupon;
use AppBundle\Entity;

class PromocionesRestController extends Controller {

    /**
     * Listado de programaciones
     * 
     * @param decimal $latitud
     * @param decimal $longitud
     * @param integer $idUsuario
     * @param integer $nroPagina
     * @param integer $tipo
     * 
     * @View(serializerGroups={"serviceUSS013"})
     */
    public function getLatitudLongitudIdusaurioNropaginaTipoAction($latitud, $longitud, $idUsuario, $nroPagina, $tipo) {
        $cantidadPorPagina = 20;
        $error;
        if ($this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->existUsaurioMovil($idUsuario)) {

            $repositoryProgramacion = $this->getDoctrine()->getRepository('AppBundle:ProgramacionEnDia');
            $program = $repositoryProgramacion->findAll(); //$programaciones = $repositoryProgramacion->findAll();
            //tipo 1 -> promocion; tipo 2 -> premio
            $programaciones = array();
            foreach ($program as $programacion) {
                $puntajePremio = $programacion->getProgramacion()->getPromocion()->getPuntajePremio();
                if ($tipo == 1 && $puntajePremio == 0) {
                    array_push($programaciones, $programacion);
                } else if ($tipo == 2 && $puntajePremio != 0) {
                    array_push($programaciones, $programacion);
                }
            }
            foreach ($programaciones as $programacion) {
                $localComercial = $programacion->
                        getProgramacion()->
                        getPromocion()->
                        getLocalComercial();
                $distance = $localComercial->getSucursalMinimaDistancia($latitud, $longitud);
                $programacion->setDistanciaALocalComercial($distance['distance']);
                $programacion->setSucursalMasCercana($distance['title']);
            }

            $repositoryProgramacion->ordenarPorDistanciaALocal($programaciones);

            $inicio = $cantidadPorPagina * ($nroPagina - 1);
            $arrayPaginaPromociones = array_slice($programaciones, $inicio, $cantidadPorPagina);
        } else {
            $error[] = array('codigo' => '3',
                'mensaje' => 'El usuario no existe',
                'descripcion' => 'El id del usuario no existe en la base de datos');
        }

        if (!isset($error)) {
            return array('promociones' => $arrayPaginaPromociones);
        } else
            return array('error' => $error);
    }

    /**
     * Genera un nuevo codigo y crea un nuevo cupon 
     * 
     * @param integer $idProgramacion
     * @param integer $idUsuario
     * @View(serializerGroups={"serviceUSS21"})
     */
    public function getId_programacionId_usuario_movilAction($idProgramacion, $idUsuarioMovil) {
        $repositoryProgramacionEnDia = $this->getDoctrine()->getRepository('AppBundle:ProgramacionEnDia');
        $repositoryUsuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil');
        $repositoryCupon = $this->getDoctrine()->getRepository('AppBundle:Cupon');
        /* @var $programacionEnDia ProgramacionEnDia */
        $programacionEnDia = $repositoryProgramacionEnDia->findByIdProgramacion($idProgramacion);
        $usuarioMovil = $repositoryUsuarioMovil->findOneById($idUsuarioMovil);

        if (is_null($programacionEnDia)) {
            $error[] = array('idProgramacion' => $idProgramacion, 'codigo' => '1',
                'mensaje' => 'La promoción ya no está disponible.',
                'descripcion' => 'El id de la programacion en dia no existe');
        } elseif ($programacionEnDia->getEstadoProgramacionEnDia()->getNombre() == 'agotada') {
            $error[] = array('idProgramacion' => $idProgramacion, 'codigo' => '2',
                'mensaje' => 'La promoción se ha agotado.',
                'descripcion' => 'el estado de la programacion es agotada');
        } elseif (!is_object($usuarioMovil)) {
            $error[] = array('codigo' => '3',
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
                $error[] = array('codigo' => '0',
                    'mensaje' => 'No se ha popido generar el nuevo cupón. Intente de nuevo más tarde.',
                    'descripcion' => 'fallo alguna de las consultaas a la base de datos y se lanzo una excepcion');
            }
        }

        if (isset($error)) {
            return array('error' => $error);
        } elseif (isset($nuevoCupon)) {
            return array("cupon" => $nuevoCupon);
        }
    }

    /**
     * Visita a programacion
     * 
     * @param String $idUsuario
     * @param String $idProgramacion     * 
     * 
     * @View(serializerGroups={"serviceUSS17-visita"})
     */
    public function getId_usuario_movilId_programacionAction($idUsuario, $idProgramacion) {
        /* @var $usuarioMovil Entity\UsuarioMovil */
        $usuarioMovil = $this->getDoctrine()->getRepository('AppBundle:UsuarioMovil')->find($idUsuario);
        /* @var $programacion Entity\Programacion */
        $programacion = $this->getDoctrine()->getRepository('AppBundle:Programacion')->find($idProgramacion);

        if ($usuarioMovil == null) {
            $error[] = array('codigo' => '3',
                'mensaje' => 'Error',
                'descripcion' => 'Usuario inexistentes!');
        } else if ($programacion == null) {
            $error[] = array('codigo' => '4',
                'mensaje' => 'Error',
                'descripcion' => 'Programacion inexistentes!');
        } else {

            /* @var $visitaPromocion Entity\VisitaPromocion */
            $visitaPromocion = new Entity\VisitaPromocion();
            $em = $this->getDoctrine()->getManager();
            $visitaPromocion->setProgramacion($programacion);
            $visitaPromocion->setUsuarioMovil($usuarioMovil);
            $hoy = new \DateTime();
            $visitaPromocion->setFecha($hoy);
            $em->persist($visitaPromocion);
            $em->flush();
        }

        if (isset($error)) {
            return array('res' => false);
        } else {
            return array('res' => true);
        }
    }

    /**
     * Devuelve estado programacion y cantidad disponible 
     * 
     * @param integer $idProgramacion
     * 
     * @View(serializerGroups={"serviceUSS89"})
     */
    public function getId_programacionAction($idProgramacion) {
        $repositoryProgramacionEnDia = $this->getDoctrine()->getRepository('AppBundle:ProgramacionEnDia');

        /* @var $programacionEnDia ProgramacionEnDia */
        $programacionEnDia = $repositoryProgramacionEnDia->findByIdProgramacion($idProgramacion);

        if (is_null($programacionEnDia)) {
            $error[] = array('idProgramacion' => $idProgramacion, 'codigo' => '1',
                'mensaje' => 'La promoción ya no está disponible.',
                'descripcion' => 'El id de la programacion en dia no existe');
        } else {
            $estado = $programacionEnDia->getEstadoProgramacionEnDia()->getNombre();
            $cantidadDisponible = $programacionEnDia->getCantidadDisponible();
        }
        if (isset($error)) {
            return array('idProgramacion' => $idProgramacion, 'error' => $error);
        } else {
            return array('idProgramacion' => $idProgramacion, 'estado' => $estado, 'cantidadDisponible' => $cantidadDisponible);
        }
    }

    /**
     * Devuelve estado de un cupon
     * 
     * @param integer $idCupon
     * @param integer $idUsuario     * 
     * 
     * @View(serializerGroups={"serviceUSS37"})
     */
    public function getId_cuponId_usuario_movilAction($idCupon, $idUsuario) {

        /* @var $cupon Entity\Cupon */
        $cupon = $this->getDoctrine()->getRepository('AppBundle:Cupon')->find($idCupon);
        if (is_null($cupon)) {
            $error[] = array('idCupon' => $idCupon, 'codigo' => '8',
                'mensaje' => 'Cupon no existe',
                'descripcion' => 'El cupon no existe');
        } else {
            /* @var $usuarioMovil Entity\UsuarioMovil */
            $usuarioMovil = $cupon->getUsuarioMovil();
            if ($usuarioMovil->getId() != $idUsuario) {
                $error[] = array('idCupon' => $idCupon, 'codigo' => '9',
                    'mensaje' => 'Cupon no corresponde al UM',
                    'descripcion' => 'El cupon no corresponde a ese UM');
            } else {
                $estado = $cupon->getEstadoCupon()->getNombre();
            }
        }
        if (isset($error)) {
            return array('idCupon' => $idCupon, 'error' => $error);
        } else {
            return array('idCupon' => $idCupon, 'estado' => $estado);
        }
    }

}
