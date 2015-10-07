<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProgramacionRepository")
 */
class Programacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer")
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date")
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
     * @ORM\Column(name="esLunes", type="boolean")
     */
    private $esLunes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esMartes", type="boolean")
     */
    private $esMartes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esMiercoles", type="boolean")
     */
    private $esMiercoles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esJueves", type="boolean")
     */
    private $esJueves;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esViernes", type="boolean")
     */
    private $esViernes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esSabado", type="boolean")
     */
    private $esSabado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esDomingo", type="boolean")
     */
    private $esDomingo;

    /**
     * @ORM\ManyToOne(targetEntity="Promocion", inversedBy="programaciones")
     * @ORM\JoinColumn(name="idPromocion", referencedColumnName="id")
     */
    private $promocion;

    /**
     * @ORM\ManyToOne(targetEntity="EstadoProgramacion", inversedBy="programaciones")
     * @ORM\JoinColumn(name="idEstadoProgramacion", referencedColumnName="id")
     */
    private $estadoProgramacion;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Programacion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     * @return Programacion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return integer 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Programacion
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Programacion
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return Programacion
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Programacion
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set esLunes
     *
     * @param boolean $esLunes
     * @return Programacion
     */
    public function setEsLunes($esLunes)
    {
        $this->esLunes = $esLunes;

        return $this;
    }

    /**
     * Get esLunes
     *
     * @return boolean 
     */
    public function getEsLunes()
    {
        return $this->esLunes;
    }

    /**
     * Set esMartes
     *
     * @param boolean $esMartes
     * @return Programacion
     */
    public function setEsMartes($esMartes)
    {
        $this->esMartes = $esMartes;

        return $this;
    }

    /**
     * Get esMartes
     *
     * @return boolean 
     */
    public function getEsMartes()
    {
        return $this->esMartes;
    }

    /**
     * Set esMiercoles
     *
     * @param boolean $esMiercoles
     * @return Programacion
     */
    public function setEsMiercoles($esMiercoles)
    {
        $this->esMiercoles = $esMiercoles;

        return $this;
    }

    /**
     * Get esMiercoles
     *
     * @return boolean 
     */
    public function getEsMiercoles()
    {
        return $this->esMiercoles;
    }

    /**
     * Set esJueves
     *
     * @param boolean $esJueves
     * @return Programacion
     */
    public function setEsJueves($esJueves)
    {
        $this->esJueves = $esJueves;

        return $this;
    }

    /**
     * Get esJueves
     *
     * @return boolean 
     */
    public function getEsJueves()
    {
        return $this->esJueves;
    }

    /**
     * Set esViernes
     *
     * @param boolean $esViernes
     * @return Programacion
     */
    public function setEsViernes($esViernes)
    {
        $this->esViernes = $esViernes;

        return $this;
    }

    /**
     * Get esViernes
     *
     * @return boolean 
     */
    public function getEsViernes()
    {
        return $this->esViernes;
    }

    /**
     * Set esSabado
     *
     * @param boolean $esSabado
     * @return Programacion
     */
    public function setEsSabado($esSabado)
    {
        $this->esSabado = $esSabado;

        return $this;
    }

    /**
     * Get esSabado
     *
     * @return boolean 
     */
    public function getEsSabado()
    {
        return $this->esSabado;
    }

    /**
     * Set esDomingo
     *
     * @param boolean $esDomingo
     * @return Programacion
     */
    public function setEsDomingo($esDomingo)
    {
        $this->esDomingo = $esDomingo;

        return $this;
    }

    /**
     * Get esDomingo
     *
     * @return boolean 
     */
    public function getEsDomingo()
    {
        return $this->esDomingo;
    }

    /**
     * Set promocion
     *
     * @param \stdClass $promocion
     * @return Programacion
     */
    public function setPromocion($promocion)
    {
        $this->promocion = $promocion;

        return $this;
    }

    /**
     * Get promocion
     *
     * @return \stdClass 
     */
    public function getPromocion()
    {
        return $this->promocion;
    }

    /**
     * Set estadoProgramacion
     *
     * @param \stdClass $estadoProgramacion
     * @return Programacion
     */
    public function setEstadoProgramacion($estadoProgramacion)
    {
        $this->estadoProgramacion = $estadoProgramacion;

        return $this;
    }

    /**
     * Get estadoProgramacion
     *
     * @return \stdClass 
     */
    public function getEstadoProgramacion()
    {
        return $this->estadoProgramacion;
    }
}
