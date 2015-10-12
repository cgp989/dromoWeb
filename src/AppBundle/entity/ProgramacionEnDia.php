<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * ProgramacionEnDia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProgramacionEnDiaRepository")
 * @ExclusionPolicy("all")
 */
class ProgramacionEnDia
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
     * @var integer
     *
     * @ORM\Column(name="cantidadDisponible", type="integer")
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $cantidadDisponible;

    /**
     * @var string
     *
     * @ORM\Column(name="validez", type="string", length=255)
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $validez;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimiento", type="datetime")
     */
    private $vencimiento;

    /**
     * @ORM\ManyToOne(targetEntity="EstadoProgramacionEnDia", inversedBy="programacionesEnDia")
     * @ORM\JoinColumn(name="idEstadoProgramacionEnDia", referencedColumnName="id")
     */
    private $estadoProgramacionEnDia;
    
    /**
     *
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $distanciaALocalComercial;
    
    /**
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $sucursalMasCercana;

    /**
     * @ORM\ManyToOne(targetEntity="Programacion")
     * @ORM\JoinColumn(name="idProgramacion", referencedColumnName="id")
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $programacion;

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
     * Set cantidadDisponible
     *
     * @param integer $cantidadDisponible
     * @return ProgramacionEnDia
     */
    public function setCantidadDisponible($cantidadDisponible)
    {
        $this->cantidadDisponible = $cantidadDisponible;

        return $this;
    }

    /**
     * Get cantidadDisponible
     *
     * @return integer 
     */
    public function getCantidadDisponible()
    {
        return $this->cantidadDisponible;
    }

    /**
     * Set validez
     *
     * @param string $validez
     * @return ProgramacionEnDia
     */
    public function setValidez($validez)
    {
        $this->validez = $validez;

        return $this;
    }

    /**
     * Get validez
     *
     * @return string 
     */
    public function getValidez()
    {
        return $this->validez;
    }

    /**
     * Set estadoProgramacionEnDia
     *
     * @param \stdClass $estadoProgramacionEnDia
     * @return ProgramacionEnDia
     */
    public function setEstadoProgramacionEnDia($estadoProgramacionEnDia)
    {
        $this->estadoProgramacionEnDia = $estadoProgramacionEnDia;

        return $this;
    }

    /**
     * Get estadoProgramacionEnDia
     *
     * @return \AppBundle\Entity\EstadoProgramacionEnDia
     */
    public function getEstadoProgramacionEnDia()
    {
        return $this->estadoProgramacionEnDia;
    }

    /**
     * Set programacion
     *
     * @param \stdClass $programacion
     * @return ProgramacionEnDia
     */
    public function setProgramacion($programacion)
    {
        $this->programacion = $programacion;

        return $this;
    }

    /**
     * Get programacion
     *
     * @return \stdClass 
     */
    public function getProgramacion()
    {
        return $this->programacion;
    }
    
    function getDistanciaALocalComercial() {
        return $this->distanciaALocalComercial;
    }

    function setDistanciaALocalComercial($distanciaALocalComercial) {
        $this->distanciaALocalComercial = $distanciaALocalComercial;
    }
    
    function getSucursalMasCercana() {
        return $this->sucursalMasCercana;
    }

    function setSucursalMasCercana($sucursalMasCercana) {
        $this->sucursalMasCercana = $sucursalMasCercana;
    }

    
    /**
     * compareTo
     *
     * @param ProgramacionEnDia $otraPromocion
     * @return integer
     */
    public function compareTo(ProgramacionEnDia $otraProgramacionEnDia) {
        if ($this->getDistanciaALocalComercial() == $otraProgramacionEnDia->getDistanciaALocalComercial())
            return 0;
        else if ($this->getDistanciaALocalComercial() > $otraProgramacionEnDia->getDistanciaALocalComercial())
            return 1;
        else if ($this->getDistanciaALocalComercial() < $otraProgramacionEnDia->getDistanciaALocalComercial())
            return -1;
    }

    /**
     * Set vencimiento
     *
     * @param \DateTime $vencimiento
     * @return ProgramacionEnDia
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento
     *
     * @return \DateTime 
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }
}
