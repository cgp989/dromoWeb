<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * TipoPromocion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TipoPromocionRepository")
 * 
 * @ExclusionPolicy("all")
 */
class TipoPromocion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceCupones"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     * @Expose
     * @Groups({"serviceUSS013", "serviceCupones"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=50)
     */
    private $descripcion;

    /**
     * ORM\OneToMany(targetEntity="Promocion", mappedBy="tipoPromocion")
     */
    private $promociones;
    
    public function __construct() {
        $this->promociones = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return TipoPromocion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function __toString() {
        return $this->getDescripcion();
    }
    
    function getDescripcion() {
        return $this->descripcion;
    }

    function getPromociones() {
        return $this->promociones;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPromociones($promociones) {
        $this->promociones = $promociones;
    }
}
