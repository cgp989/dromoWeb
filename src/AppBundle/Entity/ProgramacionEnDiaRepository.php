<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProgramacionEnDiaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProgramacionEnDiaRepository extends EntityRepository {

    /**
     * @param type $array
     * @return boolean
     */
    public function ordenarPorDistanciaALocal(&$array) {
        return uasort($array, function(ProgramacionEnDia $a, ProgramacionEnDia $b) {
            return $a->compareTo($b);
        }
        );
    }

    /**
     * 
     * @param integer $idProgramacion
     */
    public function findByIdProgramacion($idProgramacion) {
        $query = $this->getEntityManager()
                ->createQuery(
                        "select pd
                from AppBundle:ProgramacionEnDia pd
                    join pd.programacion p
                where p.id=:idProgramacion")
                ->setParameter('idProgramacion', $idProgramacion);

        return $query->getOneOrNullResult();
    }

    public function descontarCantidadDisponible(ProgramacionEnDia $programacionEnDia) {
        $programacionEnDia->setCantidadDisponible($programacionEnDia->getCantidadDisponible() - 1);
        if ($programacionEnDia->getCantidadDisponible() == 0) {
            $programacionEnDia->setEstadoProgramacionEnDia(
                    $this->getEntityManager()->getRepository('AppBundle:EstadoProgramacionEnDia')->findOneByNombre('agotada')
            );
        }
        $this->getEntityManager()->flush();
    }

    /**
     * Recorre un array con Programaciones y las inserta en la tabla ProgramacionEnDia. 
     * Luego llama a la funcion que actualiza las vigencias
     * @param array $programaciones
     */
    public function insertProgramaciones(array $programaciones) {
        $arrayProgramacionesED = array();
        $contadorInsersiones = 0;
        foreach ($programaciones as $key => $programacion) {
            $progEnDia = new ProgramacionEnDia();
            $progEnDia->setProgramacion($programacion);
            $progEnDia->setCantidadDisponible($programacion->getCantidad());
            $arrayValidez = $programacion->getValidezDelDia();
            $progEnDia->setInicio($arrayValidez['inicioValidez']);
            $progEnDia->setVencimiento($arrayValidez['finValidez']);
            $arrayProgramacionesED[] = $progEnDia; //las meto a un array para luego actualizar sus estados.
            $this->getEntityManager()->persist($progEnDia);
            $contadorInsersiones++;
        }
        $this->actualizarVigenciasProgramaciones($arrayProgramacionesED); //actualizo los estados de las programaciones en dia
        $this->getEntityManager()->flush();
        return "se insertaron " . $contadorInsersiones . " programaciones";
    }

    /**
     * Inserta una nueva programacion creada o editada desde el formulario y que esta en dia.
     * 
     * @param \AppBundle\Entity\Programacion $programacion
     */
    public function insertProgramacion(Programacion $programacion) {
        $this->insertProgramaciones(array($programacion));
    }

    /**
     * Verifica si la programacion a insertar se encuentra ya en la tabla programacionEnDia.
     * Si no se encuentra la inserta.
     * Si ya se encuentra, le actualiza LA VALIDEZ.
     * 
     * @param \AppBundle\Entity\Programacion $programacion
     * 
     */
    public function verificarProgramacion(Programacion $programacion) {
        //VERIFICO QUE LA PROGRAMACION NO EXISTA YA EN LA TABLA PROGRMACION EN DIA
        $progEnDia = $this->findOneByProgramacion($programacion);
        if (is_null($progEnDia)) {
            $this->insertProgramacion($programacion);
        } else {
            $arrayValidez = $programacion->getValidezDelDia();
            $progEnDia->setInicio($arrayValidez['inicioValidez']);
            $progEnDia->setVencimiento($arrayValidez['finValidez']);
            $this->getEntityManager()->persist($progEnDia);
            $this->getEntityManager()->flush();
        }
    }

    public function deleteProgramacion(Programacion $programacion) {
        $progEnDia = $this->findOneByProgramacion($programacion);
        if (!is_null($progEnDia)) {
            $em = $this->getEntityManager();
            $em->remove($progEnDia);
            $em->flush();
        }
    }

    /**
     * Recorre todas las programaciones del dia, verificando si se encentran en el rango horario
     * o no para actualizar su vigencia
     * 
     * @return array $arrayInfoEstados con tres indices con informacion de cuantas promociones hay agotadas, vigentes, noVigentes o se eliminaron de la tabla.
     */
    public function actualizarVigenciasProgramaciones($programacionesED = null) {
        if (is_null($programacionesED)) {
            $programacionesED = $this->findAll();
        }

        $estadoAgotada = $this->getEntityManager()->getRepository('AppBundle:EstadoProgramacionEnDia')->findOneByNombre('agotada');
        $estadoVigente = $this->getEntityManager()->getRepository('AppBundle:EstadoProgramacionEnDia')->findOneByNombre('vigente');
        $estadoNoVigente = $this->getEntityManager()->getRepository('AppBundle:EstadoProgramacionEnDia')->findOneByNombre('noVigente');

        /* @var $programacionED ProgramacionEnDia */
        $programacionED;
        $fechaActual = new \DateTime('now');
        $arrayInfoEstados = array('agotadas' => 0, 'vigentes' => 0, 'noVigentes' => 0, 'eliminadas' => 0);
        foreach ($programacionesED as $key => $value) {
            $programacionED = $value;

            if ($fechaActual < $programacionED->getInicio()) {
                $programacionED->setEstadoProgramacionEnDia($estadoNoVigente);
                $arrayInfoEstados['noVigentes'] ++;
                $this->getEntityManager()->persist($programacionED);
            } elseif ($fechaActual >= $programacionED->getInicio() && $fechaActual <= $programacionED->getVencimiento()) {
                if ($programacionED->getCantidadDisponible() == 0) {
                    $programacionED->setEstadoProgramacionEnDia($estadoAgotada);
                    $arrayInfoEstados['agotadas'] ++;
                } else {
                    $programacionED->setEstadoProgramacionEnDia($estadoVigente);
                    $arrayInfoEstados['vigentes'] ++;
                }
                $this->getEntityManager()->persist($programacionED);
            } else {
                // si ya paso a fecha de vencimiento la elimino
                $this->getEntityManager()->remove($programacionED);
                $arrayInfoEstados['eliminadas'] ++;
            }
        }
        $this->getEntityManager()->flush();
        return $arrayInfoEstados;
    }

    public function eliminarProgramacionesEnDia() {
        $this->getEntityManager()->createQuery('DELETE FROM AppBundle:ProgramacionEnDia')->execute();
        $this->getEntityManager()->flush();
    }

    function getProgramacionesLocal($idLocal) {
        $promociones = $this->getEntityManager()
                ->createQuery('SELECT prd FROM AppBundle:ProgramacionEnDia prd '
                        . 'LEFT JOIN prd.programacion pr '
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

    function getPremios() {
        $promociones = $this->getEntityManager()
                ->createQuery('SELECT prd FROM AppBundle:ProgramacionEnDia prd '
                        . 'LEFT JOIN prd.programacion pr '
                        . 'LEFT JOIN pr.promocion p '
                        . 'LEFT JOIN p.localComercial l '
                        . 'LEFT JOIN pr.estadoProgramacion epr '
                        . 'LEFT JOIN p.estadoPromocion e '
                        . 'LEFT JOIN p.tipoPromocion t '
                        . 'WHERE epr.nombre != :nombreEstadoPr AND e.nombre != :nombreEstadoP '
                        . ' AND t.nombre = :tipoPromocion')
                ->setParameters(array(
                    'tipoPromocion' => 'Premio',
                    'nombreEstadoPr' => 'eliminada',
                    'nombreEstadoP' => 'eliminada'))
                ->getResult();
        return $promociones;
    }

}
