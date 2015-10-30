<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Promocion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PromocionRepository")
 * 
 * @ExclusionPolicy("all")
 */
class Promocion
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
     * @ORM\Column(name="titulo", type="string", length=25)
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500)
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="precio")
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $precio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estaModerada", type="boolean")
     */
    private $estaModerada;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntajePremio", type="integer")
     */
    private $puntajePremio;

    /**
     * @ORM\ManyToOne(targetEntity="EstadoPromocion", inversedBy="promociones")
     * @ORM\JoinColumn(name="idEstadoPromocion", referencedColumnName="id")
     * 
     */
    private $estadoPromocion;

    /**
     * @ORM\ManyToOne(targetEntity="TipoPromocion", inversedBy="promociones")
     * @ORM\JoinColumn(name="idTipoPromocion", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $tipoPromocion;
    
    /**
     * @ORM\ManyToOne(targetEntity="LocalComercial", inversedBy="promociones")
     * @ORM\JoinColumn(name="idLocalComercial", referencedColumnName="id")
     */
    private $localComercial;

    /**
     * @ORM\OneToMany(targetEntity="Programacion", mappedBy="promocion")
     */
    private $programaciones;
    
    public function __construct() {
        $this->programaciones = new ArrayCollection();
    }

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
     * @return Promocion
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
     * Set precio
     *
     * @param float $precio
     * @return Promocion
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Promocion
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set estaModerada
     *
     * @param boolean $estaModerada
     * @return Promocion
     */
    public function setEstaModerada($estaModerada)
    {
        $this->estaModerada = $estaModerada;

        return $this;
    }

    /**
     * Get estaModerada
     *
     * @return boolean 
     */
    public function getEstaModerada()
    {
        return $this->estaModerada;
    }

    /**
     * Set puntajePremio
     *
     * @param integer $puntajePremio
     * @return Promocion
     */
    public function setPuntajePremio($puntajePremio)
    {
        $this->puntajePremio = $puntajePremio;

        return $this;
    }

    /**
     * Get puntajePremio
     *
     * @return integer 
     */
    public function getPuntajePremio()
    {
        return $this->puntajePremio;
    }

    /**
     * Set estadoPromocion
     *
     * @param \stdClass $estadoPromocion
     * @return Promocion
     */
    public function setEstadoPromocion($estadoPromocion)
    {
        $this->estadoPromocion = $estadoPromocion;

        return $this;
    }

    /**
     * Get estadoPromocion
     *
     * @return \stdClass 
     */
    public function getEstadoPromocion()
    {
        return $this->estadoPromocion;
    }

    /**
     * Set tipoPromocion
     *
     * @param \stdClass $tipoPromocion
     * @return Promocion
     */
    public function setTipoPromocion($tipoPromocion)
    {
        $this->tipoPromocion = $tipoPromocion;

        return $this;
    }

    /**
     * Get tipoPromocion
     *
     * @return \stdClass 
     */
    public function getTipoPromocion()
    {
        return $this->tipoPromocion;
    }

    /**
     * Add programaciones
     *
     * @param \AppBundle\Entity\Programacion $programaciones
     * @return Promocion
     */
    public function addProgramacione(\AppBundle\Entity\Programacion $programaciones)
    {
        $this->programaciones[] = $programaciones;

        return $this;
    }

    /**
     * Remove programaciones
     *
     * @param \AppBundle\Entity\Programacion $programaciones
     */
    public function removeProgramacione(\AppBundle\Entity\Programacion $programaciones)
    {
        $this->programaciones->removeElement($programaciones);
    }

    /**
     * Get programaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgramaciones()
    {
        return $this->programaciones;
    }

    /**
     * Set localComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return Promocion
     */
    public function setLocalComercial(\AppBundle\Entity\LocalComercial $localComercial = null)
    {
        $this->localComercial = $localComercial;

        return $this;
    }

    /**
     * Get localComercial
     *
     * @return \AppBundle\Entity\LocalComercial 
     */
    public function getLocalComercial()
    {
        return $this->localComercial;
    }
    
    public function __toString() {
        return $this->getTipoPromocion().': '.$this->getTitulo();
    }
}
