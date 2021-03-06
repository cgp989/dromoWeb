<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * VisitaPromocionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VisitaPromocionRepository extends EntityRepository {

    //Cantidad de visitas a cada promocion
    public function getVisitas($idLocal, $desde, $hasta) {
        $desde = date("Y-m-d", strtotime($desde));
        $hasta = date("Y-m-d", strtotime($hasta));
        $visitas = $this->getEntityManager()
                ->createQuery('SELECT concat(t.descripcion, r.titulo) as titulo, count(v.id) as cant FROM AppBundle:VisitaPromocion v '
                        . ' JOIN v.programacion p '
                        . ' JOIN p.promocion r '
                        . ' JOIN r.localComercial l'
                        . ' JOIN r.tipoPromocion t'
                        . ' WHERE l.id = :idLocal and v.fecha > :desde and v.fecha < :hasta '
                        . ' GROUP BY t.descripcion, r.titulo ')
                ->setParameters(array(
                    'idLocal' => $idLocal,
                    'desde' => $desde,
                    'hasta' => $hasta,
                ))
                ->getResult();
        return $visitas;
    }

    //Cantidad de cupones canjeados por promocion
    public function getCuponesPromocion($idLocal, $desde, $hasta) {
        $desde = date("Y-m-d", strtotime($desde));
        $hasta = date("Y-m-d", strtotime($hasta));
        $visitas = $this->getEntityManager()
                ->createQuery('SELECT concat(t.descripcion, r.titulo) as titulo, count(c.id) as cant FROM AppBundle:Cupon c '
                        . ' JOIN c.programacion p '
                        . ' JOIN p.promocion r '
                        . ' JOIN r.localComercial l'
                        . ' JOIN r.tipoPromocion t'
                        . ' WHERE l.id = :idLocal and c.fecha > :desde and c.fecha < :hasta '
                        . ' GROUP BY t.descripcion,r.titulo ')
                ->setParameters(array(
                    'idLocal' => $idLocal,
                    'desde' => $desde,
                    'hasta' => $hasta,
                ))
                ->getResult();
        return $visitas;
    }

    //Cantidad de visitas a cada promocion por sexo
    public function getVisitasPorSexo($idLocal) {
        $visitas = $this->getEntityManager()
                ->createQuery('SELECT u.sexo as titulo, count(v.id) as cant FROM AppBundle:VisitaPromocion v '
                        . ' JOIN v.programacion p '
                        . ' JOIN p.promocion r '
                        . ' JOIN r.localComercial l'
                        . ' JOIN v.usuarioMovil u'
                        . ' WHERE l.id = :idLocal '
                        . ' GROUP BY u.sexo ')
                ->setParameters(array(
                    'idLocal' => $idLocal
                ))
                ->getResult();
        return $visitas;
    }

    //Cantidad de cupones canjeados por promocion
    public function getGananciaLocal($idLocal, $desde, $hasta) {
        $desde = date("Y-m-d", strtotime($desde));
        $hasta = date("Y-m-d", strtotime($hasta));
        $visitas = $this->getEntityManager()
                ->createQuery('SELECT concat(t.descripcion, r.titulo) as titulo, sum(r.precio-c.precioCobroLocal) as cant FROM AppBundle:Cupon c '
                        . ' JOIN c.programacion p '
                        . ' JOIN p.promocion r '
                        . ' JOIN r.localComercial l'
                        . ' JOIN r.tipoPromocion t'
                        . ' WHERE l.id = :idLocal and c.fecha > :desde and c.fecha < :hasta '
                        . ' GROUP BY t.descripcion,r.titulo ')
                ->setParameters(array(
                    'idLocal' => $idLocal,
                    'desde' => $desde,
                    'hasta' => $hasta,
                ))
                ->getResult();
        return $visitas;
    }

}
