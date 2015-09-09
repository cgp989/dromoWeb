<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromocionEnDia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PromocionEnDiaRepository")
 */
class PromocionEnDia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProgramacion", type="integer")
     * @ORM\Id
     */
    private $idProgramacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="idLocalComercial", type="integer")
     */
    private $idLocalComercial;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoPromocion", type="string", length=50)
     */
    private $tipoPromocion;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitulo", type="string", length=255)
     */
    private $subtitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float")
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidadRestante", type="integer")
     */
    private $cantidadRestante;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=50)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="validez", type="string", length=255)
     */
    private $validez;

    /**
     * @var string
     *
     * @ORM\Column(name="distanciaALocalComercial", type="string", length=255)
     */
    private $distanciaALocalComercial;


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
     * Set idProgramacion
     *
     * @param integer $idProgramacion
     * @return PromocionEnDia
     */
    public function setIdProgramacion($idProgramacion)
    {
        $this->idProgramacion = $idProgramacion;

        return $this;
    }

    /**
     * Get idProgramacion
     *
     * @return integer 
     */
    public function getIdProgramacion()
    {
        return $this->idProgramacion;
    }

    /**
     * Set idLocalComercial
     *
     * @param integer $idLocalComercial
     * @return PromocionEnDia
     */
    public function setIdLocalComercial($idLocalComercial)
    {
        $this->idLocalComercial = $idLocalComercial;

        return $this;
    }

    /**
     * Get idLocalComercial
     *
     * @return integer 
     */
    public function getIdLocalComercial()
    {
        return $this->idLocalComercial;
    }

    /**
     * Set tipoPromocion
     *
     * @param string $tipoPromocion
     * @return PromocionEnDia
     */
    public function setTipoPromocion($tipoPromocion)
    {
        $this->tipoPromocion = $tipoPromocion;

        return $this;
    }

    /**
     * Get tipoPromocion
     *
     * @return string 
     */
    public function getTipoPromocion()
    {
        return $this->tipoPromocion;
    }

    /**
     * Set subtitulo
     *
     * @param string $subtitulo
     * @return PromocionEnDia
     */
    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;

        return $this;
    }

    /**
     * Get subtitulo
     *
     * @return string 
     */
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return PromocionEnDia
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
     * @return PromocionEnDia
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
     * Set cantidadRestante
     *
     * @param integer $cantidadRestante
     * @return PromocionEnDia
     */
    public function setCantidadRestante($cantidadRestante)
    {
        $this->cantidadRestante = $cantidadRestante;

        return $this;
    }

    /**
     * Get cantidadRestante
     *
     * @return integer 
     */
    public function getCantidadRestante()
    {
        return $this->cantidadRestante;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return PromocionEnDia
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set validez
     *
     * @param string $validez
     * @return PromocionEnDia
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
     * Set distanciaALocalComercial
     *
     * @param string $distanciaALocalComercial
     * @return PromocionEnDia
     */
    public function setDistanciaALocalComercial($distanciaALocalComercial)
    {
        $this->distanciaALocalComercial = $distanciaALocalComercial;

        return $this;
    }

    /**
     * Get distanciaALocalComercial
     *
     * @return string 
     */
    public function getDistanciaALocalComercial()
    {
        return $this->distanciaALocalComercial;
    }
}
