<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Cupon
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CuponRepository")
 * @ExclusionPolicy("all")
 */
class Cupon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS21"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255)
     * 
     * @Expose
     * @Groups({"serviceUSS21"})
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     * 
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVencimiento", type="date")
     * 
     */
    private $fechaVencimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntaje", type="integer", nullable=TRUE)
     * 
     * @Expose
     * @Groups({"serviceUSS21"})
     */
    private $puntaje;
    
    /**
     * @ORM\ManyToOne(targetEntity="Programacion", inversedBy="cupones")
     * @ORM\JoinColumn(name="idProgramacion", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS21"})
     */
    private $programacion;
    
    /**
     * @ORM\ManyToOne(targetEntity="UsuarioMovil", inversedBy="cupones")
     * @ORM\JoinColumn(name="idUsuarioMovil", referencedColumnName="id")
     */
    private $usuarioMovil;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoCupon", inversedBy="cupones")
     * @ORM\JoinColumn(name="idTipoCupon", referencedColumnName="id")
     */
    private $tipoCupon;
    
    /**
     * @ORM\ManyToOne(targetEntity="EstadoCupon", inversedBy="cupones")
     * @ORM\JoinColumn(name="idEstadoCupon", referencedColumnName="id")
     */
    private $estadoCupon;


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
     * Set codigo
     *
     * @param string $codigo
     * @return Cupon
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Cupon
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }


    /**
     * Set puntaje
     *
     * @param integer $puntaje
     * @return Cupon
     */
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;

        return $this;
    }

    /**
     * Get puntaje
     *
     * @return integer 
     */
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set programacion
     *
     * @param \AppBundle\Entity\Programacion $programacion
     * @return Cupon
     */
    public function setProgramacion(\AppBundle\Entity\Programacion $programacion = null)
    {
        $this->programacion = $programacion;

        return $this;
    }

    /**
     * Get programacion
     *
     * @return \AppBundle\Entity\Programacion 
     */
    public function getProgramacion()
    {
        return $this->programacion;
    }

    /**
     * Set usuarioMovil
     *
     * @param \AppBundle\Entity\UsuarioMovil $usuarioMovil
     * @return Cupon
     */
    public function setUsuarioMovil(\AppBundle\Entity\UsuarioMovil $usuarioMovil = null)
    {
        $this->usuarioMovil = $usuarioMovil;

        return $this;
    }

    /**
     * Get usuarioMovil
     *
     * @return \AppBundle\Entity\UsuarioMovil 
     */
    public function getUsuarioMovil()
    {
        return $this->usuarioMovil;
    }

    /**
     * Set tipoCupon
     *
     * @param \AppBundle\Entity\TipoCupon $tipoCupon
     * @return Cupon
     */
    public function setTipoCupon(\AppBundle\Entity\TipoCupon $tipoCupon = null)
    {
        $this->tipoCupon = $tipoCupon;

        return $this;
    }

    /**
     * Get tipoCupon
     *
     * @return \AppBundle\Entity\TipoCupon 
     */
    public function getTipoCupon()
    {
        return $this->tipoCupon;
    }

    /**
     * Set estadoCupon
     *
     * @param \AppBundle\Entity\EstadoCupon $estadoCupon
     * @return Cupon
     */
    public function setEstadoCupon(\AppBundle\Entity\EstadoCupon $estadoCupon = null)
    {
        $this->estadoCupon = $estadoCupon;

        return $this;
    }

    /**
     * Get estadoCupon
     *
     * @return \AppBundle\Entity\EstadoCupon 
     */
    public function getEstadoCupon()
    {
        return $this->estadoCupon;
    }

    /**
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     * @return Cupon
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \String 
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }
    
    /**
     * Retorna la fecha formateada
     * 
     * @return String
     * @VirtualProperty 
     * @Groups({"serviceUSS21"})
     */
    public function getFecha_(){
        return $this->fecha->format("y-m-d");
    }
    
    /**
     * Retorna la fecha vencimiento formateada
     * 
     * @return String
     * @VirtualProperty 
     * @Groups({"serviceUSS21"})
     */
    public function getFechaVencimiento_(){
        return $this->fechaVencimiento->format("y-m-d");
    }   
}
