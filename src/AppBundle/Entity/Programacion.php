<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Programacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProgramacionRepository")
 * @ExclusionPolicy("all")
 * @ORM\HasLifecycleCallbacks
 */
class Programacion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS013", "serviceUSS21", "serviceCupones"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer")
     * @Expose
     * @Groups({"serviceUSS013", "serviceCupones"})
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date")
     * @Expose
     * @Groups({"serviceCupones"})
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="date")
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaInicio", type="time") 
     * 
     * 
     */
    private $horaInicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esLunes", type="boolean", options={"default" = 0})
     */
    private $esLunes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esMartes", type="boolean", options={"default" = 0})
     */
    private $esMartes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esMiercoles", type="boolean", options={"default" = 0})
     */
    private $esMiercoles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esJueves", type="boolean", options={"default" = 0})
     */
    private $esJueves;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esViernes", type="boolean", options={"default" = 0})
     */
    private $esViernes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esSabado", type="boolean", options={"default" = 0})
     */
    private $esSabado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esDomingo", type="boolean", options={"default" = 0})
     */
    private $esDomingo;

    /**
     * @ORM\ManyToOne(targetEntity="Promocion", inversedBy="programaciones")
     * @ORM\JoinColumn(name="idPromocion", referencedColumnName="id")
     * @Expose
     * @Groups({"serviceUSS013", "serviceCupones"})
     */
    private $promocion;

    /**
     * @ORM\ManyToOne(targetEntity="EstadoProgramacion", inversedBy="programaciones")
     * @ORM\JoinColumn(name="idEstadoProgramacion", referencedColumnName="id")
     */
    private $estadoProgramacion;

    /*
     * @ORM\OneToMany(targetEntity="Cupon", mappedBy="programacion")
     */
    private $cupones;

    /**
     * @ORM\OneToMany(targetEntity="VisitaPromocion", mappedBy="programacion")
     */
    private $visitasPromocion;

    public function __construct() {
        $this->fechaInicio = new \DateTime('now');
        $this->fechaFin = new \DateTime('now');
        $this->cupones = new ArrayCollection();
        $this->visitasPromocion = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Programacion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     * @return Programacion
     */
    public function setDuracion($duracion) {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return integer 
     */
    public function getDuracion() {
        return $this->duracion;
    }

    public function getDuracion_() {
        $arrayHoras = array(1 => '0:30', 2 => '1:00', 3 => '1:30', 4 => '2:00', 5 => '2:30', 6 => '3:00', 7 => '3:30', 8 => '4:00', 9 => '4:30', 10 => '5:00', 11 => '5:30', 12 => '6:00', 13 => '6:30', 14 => '7:00', 15 => '7:30', 16 => '8:00', 17 => '8:30', 18 => '9:00', 19 => '9:30', 20 => '10:00', 21 => '10:30', 22 => '11:00', 23 => '11:30', 24 => '12:00', 25 => '12:30', 26 => '13:00', 27 => '13:30', 28 => '14:00', 29 => '14:30', 30 => '15:00', 31 => '15:30', 32 => '16:00', 33 => '16:30', 34 => '17:00', 35 => '17:30', 36 => '18:00', 37 => '18:30', 38 => '19:00', 39 => '19:30', 40 => '20:00', 41 => '20:30', 42 => '21:00', 43 => '21:30', 44 => '22:00', 45 => '22:30', 46 => '23:00', 47 => '23:30', 48 => '24:00');
        return $arrayHoras[$this->duracion];
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Programacion
     */
    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Programacion
     */
    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin() {
        return $this->fechaFin;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return Programacion
     */
    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio() {
        return $this->horaInicio;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Programacion
     */
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad() {
        return $this->cantidad;
    }

    /**
     * Set esLunes
     *
     * @param boolean $esLunes
     * @return Programacion
     */
    public function setEsLunes($esLunes) {
        $this->esLunes = $esLunes;

        return $this;
    }

    /**
     * Get esLunes
     *
     * @return boolean 
     */
    public function getEsLunes() {
        return $this->esLunes;
    }

    /**
     * Set esMartes
     *
     * @param boolean $esMartes
     * @return Programacion
     */
    public function setEsMartes($esMartes) {
        $this->esMartes = $esMartes;

        return $this;
    }

    /**
     * Get esMartes
     *
     * @return boolean 
     */
    public function getEsMartes() {
        return $this->esMartes;
    }

    /**
     * Set esMiercoles
     *
     * @param boolean $esMiercoles
     * @return Programacion
     */
    public function setEsMiercoles($esMiercoles) {
        $this->esMiercoles = $esMiercoles;

        return $this;
    }

    /**
     * Get esMiercoles
     *
     * @return boolean 
     */
    public function getEsMiercoles() {
        return $this->esMiercoles;
    }

    /**
     * Set esJueves
     *
     * @param boolean $esJueves
     * @return Programacion
     */
    public function setEsJueves($esJueves) {
        $this->esJueves = $esJueves;

        return $this;
    }

    /**
     * Get esJueves
     *
     * @return boolean 
     */
    public function getEsJueves() {
        return $this->esJueves;
    }

    /**
     * Set esViernes
     *
     * @param boolean $esViernes
     * @return Programacion
     */
    public function setEsViernes($esViernes) {
        $this->esViernes = $esViernes;

        return $this;
    }

    /**
     * Get esViernes
     *
     * @return boolean 
     */
    public function getEsViernes() {
        return $this->esViernes;
    }

    /**
     * Set esSabado
     *
     * @param boolean $esSabado
     * @return Programacion
     */
    public function setEsSabado($esSabado) {
        $this->esSabado = $esSabado;

        return $this;
    }

    /**
     * Get esSabado
     *
     * @return boolean 
     */
    public function getEsSabado() {
        return $this->esSabado;
    }

    /**
     * Set esDomingo
     *
     * @param boolean $esDomingo
     * @return Programacion
     */
    public function setEsDomingo($esDomingo) {
        $this->esDomingo = $esDomingo;

        return $this;
    }

    /**
     * Get esDomingo
     *
     * @return boolean 
     */
    public function getEsDomingo() {
        return $this->esDomingo;
    }

    /**
     * Set promocion
     *
     * @param \stdClass $promocion
     * @return Programacion
     */
    public function setPromocion($promocion) {
        $this->promocion = $promocion;

        return $this;
    }

    /**
     * Get promocion
     *
     * @return \stdClass 
     */
    public function getPromocion() {
        return $this->promocion;
    }

    /**
     * Set estadoProgramacion
     *
     * @param \stdClass $estadoProgramacion
     * @return Programacion
     */
    public function setEstadoProgramacion($estadoProgramacion) {
        $this->estadoProgramacion = $estadoProgramacion;

        return $this;
    }

    /**
     * Get estadoProgramacion
     *
     * @return \stdClass 
     */
    public function getEstadoProgramacion() {
        return $this->estadoProgramacion;
    }

    /**
     * Retorna la fecha hora de inicio formateada
     * 
     * @return String
     * @VirtualProperty 
     * @Groups({"serviceUSS013", "serviceCupones"})
     */
    public function getHoraInicio_() {
        return $this->horaInicio->format("H:i");
    }

    public function getDias() {
        $str = [];
        if ($this->getEsLunes())
            $str[] = 'Lunes';
        if ($this->getEsMartes())
            $str[] = 'Martes';
        if ($this->getEsMiercoles())
            $str[] = 'Miercoles';
        if ($this->getEsJueves())
            $str[] = 'Jueves';
        if ($this->getEsViernes())
            $str[] = 'Viernes';
        if ($this->getEsSabado())
            $str[] = 'Sabado';
        if ($this->getEsDomingo())
            $str[] = 'Domingo';

        return implode(', ', $str);
    }

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        if (is_null($this->getEsLunes()))
            $this->setEsLunes(0);
        if (is_null($this->getEsMartes()))
            $this->setEsMartes(0);
        if (is_null($this->getEsMiercoles()))
            $this->setEsMiercoles(0);
        if (is_null($this->getEsJueves()))
            $this->setEsJueves(0);
        if (is_null($this->getEsViernes()))
            $this->setEsViernes(0);
        if (is_null($this->getEsSabado()))
            $this->setEsSabado(0);
        if (is_null($this->getEsDomingo()))
            $this->setEsDomingo(0);
    }

    /**
     * verifica que al menos un dia sea insertado como true
     * 
     * @param ExecutionContextInterface $context
     */
    public function isValidDays(ExecutionContextInterface $context) {
        if (!$this->getEsLunes() && !$this->getEsMartes() && !$this->getEsMiercoles() && !$this->getEsJueves() && !$this->getEsViernes() && !$this->getEsSabado() && !$this->getEsDomingo()) {
            $context->addViolation("Debe seleccionar al menos un día");
        }
    }

    /**
     * Calcula para el dia actual el DateTime de inicio y el DateTime de vencimiento y lo retorna en un array
     * @return array: fechaInicio => \DateTime, fechaFin => \DateTime
     */
    public function getValidezDelDia() {
        $arrayHoraInicio = getdate($this->getHoraInicio()->getTimestamp());
        $duracion = $this->getDuracion();
        $horaD = (int) $duracion / 2;
        if ($duracion % 2)
            $minutosD = 30;
        else
            $minutosD = 0;

        $inicioValidez = new \DateTime('now');
        $inicioValidez->setTime($arrayHoraInicio['hours'], $arrayHoraInicio['minutes'], 0);
        $finValidez = clone $inicioValidez;
        $finValidez->add(new \DateInterval('PT' . (integer) $horaD . 'H' . $minutosD . 'M'));

        return array('inicioValidez' => $inicioValidez, 'finValidez' => $finValidez);
    }

    /**
     * Add visitasPromocion
     *
     * @param \AppBundle\Entity\VisitaPromocion $visitasPromocion
     * @return Programacion
     */
    public function addVisitasPromocion(\AppBundle\Entity\VisitaPromocion $visitasPromocion) {
        $this->visitasPromocion[] = $visitasPromocion;

        return $this;
    }

    /**
     * Remove visitasPromocion
     *
     * @param \AppBundle\Entity\VisitaPromocion $visitasPromocion
     */
    public function removeVisitasPromocion(\AppBundle\Entity\VisitaPromocion $visitasPromocion) {
        $this->visitasPromocion->removeElement($visitasPromocion);
    }

    /**
     * Get visitasPromocion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisitasPromocion() {
        return $this->visitasPromocion;
    }

    /**
     * Add cupones
     *
     * @param \AppBundle\Entity\Cupon $cupones
     * @return Programacion
     */
    public function addCupone(\AppBundle\Entity\Cupon $cupones) {
        $this->cupones[] = $cupones;

        return $this;
    }

    /**
     * Remove cupones
     *
     * @param \AppBundle\Entity\Cupon $cupones
     */
    public function removeCupone(\AppBundle\Entity\Cupon $cupones) {
        $this->cupones->removeElement($cupones);
    }

    /**
     * Get cupones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCupone() {
        return $this->cupones;
    }

}
