<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProgramacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProgramacionRepository extends EntityRepository {

    /**
     * Retorna un array con las programaciones de el local pasado por id y que no esten eliminadas
     * @param integer $idLocal
     * @return array
     */
    function getProgramacionesLocal($idLocal) {
        $promociones = $this->getEntityManager()
                ->createQuery('SELECT pr FROM AppBundle:Programacion pr '
                        . 'LEFT JOIN pr.promocion p '
                        . 'LEFT JOIN p.localComercial l '
                        . 'LEFT JOIN pr.estadoProgramacion epr '
                        . 'LEFT JOIN p.estadoPromocion e '
                        . 'WHERE l.id = :idLocal AND epr.nombre != :nombreEstadoPr AND e.nombre != :nombreEstadoP')
                ->setParameters(array(
                    'idLocal' => $idLocal,
                    'nombreEstadoPr' => 'eliminada',
                    'nombreEstadoP' => 'eliminada'))
                ->getResult();
        return $promociones;
    }
    
    /**
     * Retorna un array con las programaciones de una promocion y que no esten eliminadas
     * @param integer $idPromocion
     * @return array
     */
    function getProgramacionesPromocion($idPromocion) {
        $promociones = $this->getEntityManager()
                ->createQuery('SELECT pr FROM AppBundle:Programacion pr '
                        . 'LEFT JOIN pr.promocion p '
                        . 'LEFT JOIN p.localComercial l '
                        . 'LEFT JOIN pr.estadoProgramacion epr '
                        . 'LEFT JOIN p.estadoPromocion e '
                        . 'WHERE p.id = :idPromocion AND epr.nombre != :nombreEstadoPr AND e.nombre != :nombreEstadoP')
                ->setParameters(array(
                    'idPromocion' => $idPromocion,
                    'nombreEstadoPr' => 'eliminada',
                    'nombreEstadoP' => 'eliminada'))
                ->getResult();
        return $promociones;
    }

    function getProgramacionesPremios() {
        $promociones = $this->getEntityManager()
                ->createQuery('SELECT pr FROM AppBundle:Programacion pr '
                        . 'LEFT JOIN pr.promocion p '
                        . 'LEFT JOIN p.localComercial l '
                        . 'LEFT JOIN pr.estadoProgramacion epr '
                        . 'LEFT JOIN p.estadoPromocion e '
                        . 'WHERE epr.nombre != :nombreEstadoPr AND e.nombre != :nombreEstadoP and p.puntajePremio != 0')
                ->setParameters(array(
                    'nombreEstadoPr' => 'eliminada',
                    'nombreEstadoP' => 'eliminada'))
                ->getResult();
        return $promociones;
    }
    
     function getProgramacionesPremiosProm($idPromocion) {
        $promociones = $this->getEntityManager()
                ->createQuery('SELECT pr FROM AppBundle:Programacion pr '
                        . 'LEFT JOIN pr.promocion p '
                        . 'LEFT JOIN p.localComercial l '
                        . 'LEFT JOIN pr.estadoProgramacion epr '
                        . 'LEFT JOIN p.estadoPromocion e '
                        . 'WHERE p.id= :idPromocion and epr.nombre != :nombreEstadoPr AND e.nombre != :nombreEstadoP and p.puntajePremio != 0')
                ->setParameters(array(
                    'nombreEstadoPr' => 'eliminada',
                    'idPromocion' => $idPromocion,
                    'nombreEstadoP' => 'eliminada'))
                ->getResult();
        return $promociones;
    }

    function eliminarProgramacionesConPromocion(Promocion $promocion) {
        $programaciones = $this->findByPromocion($promocion);
        $estadoEliminada = $this->getEntityManager()->
                        getRepository('AppBundle:EstadoProgramacion')->findOneByNombre('eliminada');
        if (!is_null($programaciones) && is_array($programaciones)) {
            foreach ($programaciones as $programacion) {
                if ($this->estaEnDiaProgramacion($programacion))
                    $this->getEntityManager()->getRepository('AppBundle:ProgramacionEnDia')->deleteProgramacion($programacion);

                $programacion->setEstadoProgramacion($estadoEliminada);
                $this->getEntityManager()->persist($programacion);
            }
            $this->getEntityManager()->flush();
        }
    }

    function estaEnDiaProgramacion(Programacion $programacion) {
        $fechaHoy = new \DateTime('now');
        if ($programacion->getFechaInicio() <= $fechaHoy && $fechaHoy <= $programacion->getFechaFin() && $programacion->getEstadoProgramacion()->getNombre() == 'activada') {
            switch (date('w', $fechaHoy->getTimestamp())) {
                case 0:
                    return $programacion->getEsDomingo();
                case 1:
                    return $programacion->getEsLunes();
                case 2:
                    return $programacion->getEsMartes();
                case 3:
                    return $programacion->getEsMiercoles();
                case 4:
                    return $programacion->getEsJueves();
                case 5:
                    return $programacion->getEsViernes();
                case 6:
                    return $programacion->getEsSabado();
            }
        } else {
            return false;
        }
    }

    function getProgramacionesEnDia() {
        $arrayColumDias = array(0 => 'esDomingo', 1 => 'esLunes', 2 => 'esMartes', 3 => 'esMiercoles', 4 => 'esJueves', 5 => 'esViernes', 6 => 'esSabado');
        $fechaHoy = new \DateTime('now');
        $numeroDiaHoy = date('w', $fechaHoy->getTimestamp());

        $programaciones = $this->getEntityManager()
                ->createQuery('SELECT pr FROM AppBundle:Programacion pr '
                        . 'LEFT JOIN pr.promocion p '
                        . 'LEFT JOIN pr.estadoProgramacion epr '
                        . 'LEFT JOIN p.estadoPromocion ep '
                        . 'WHERE pr.fechaInicio <= CURRENT_DATE() AND pr.fechaFin >= CURRENT_DATE() AND pr.' . $arrayColumDias[$numeroDiaHoy] . ' = 1'
                        . ' AND epr.nombre = :nombreEstadoPr AND ep.nombre = :nombreEstadoP')
                ->setParameters(array(
                    'nombreEstadoPr' => 'activada',
                    'nombreEstadoP' => 'activada'))
                ->getResult();
        return $programaciones;
    }

    function validaFechaFin(Programacion $programacion) {
        $fechaHoy = new \DateTime('now');
        $fechaHoy->setTime(0, 0, 0);
        $fechaInicio=$programacion->getFechaInicio();
        $fechaInicio->setTime(0, 0, 0);
        $feechaFin=$programacion->getFechaFin();
        $feechaFin->setTime(0, 0, 0);
        if ($fechaInicio <= $feechaFin) {
            return true;
        } else {
            return false;
        }
    }
    
    function validaFechaInicio(Programacion $programacion) {
        $fechaHoy = new \DateTime('now');
        $fechaHoy->setTime(0, 0, 0);
        $fechaInicio=$programacion->getFechaInicio();
        $fechaInicio->setTime(0, 0, 0);
        $feechaFin=$programacion->getFechaFin();
        $feechaFin->setTime(0, 0, 0);
        if ($fechaInicio >= $fechaHoy) {
            return true;
        } else {
            return false;
        }
    }
       
    function descontarTotalPremio(Programacion $progPremio){
        $em = $this->getEntityManager();
        $progPremio->setCantidadTotal($progPremio->getCantidadTotal()-1);
        
        if($progPremio->getCantidadTotal() < $progPremio->getCantidad()){
            $progPremio->setCantidad($progPremio->getCantidadTotal());
        }
        
        if($progPremio->getCantidadTotal() == 0){
            $estadoEliminada = $em->getRepository('AppBundle:EstadoProgramacion')->findByNombre('eliminada');
            $progPremio->setEstadoProgramacion($estadoEliminada);
        }
        
        $em->persist($progPremio);
        $em->flush();
    }
    
    function sumTotalGastadoEnPremio(Programacion $progPremio){
        $em = $this->getEntityManager();
        $cantTotal = $progPremio->getCantidadTotal();
        $gastoUnitario = $progPremio->getPromocion()->getPuntajePremioPlata($em);
        $totalGastado = $cantTotal*$gastoUnitario;
        $totales = $em->getRepository('AppBundle:Totales')->findAll();
        $totales[0]->setTotalGastadoPremios($totales[0]->getTotalGastadoPremios()+$totalGastado);
        $em->persist($totales[0]);
        $em->flush();
    }
}
