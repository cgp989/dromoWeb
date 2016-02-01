<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * EstadoPromocion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EstadoPromocionRepository")
 * 
 * @ExclusionPolicy("all")
 */
class EstadoPromocion
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
     * @ORM\Column(name="nombre", type="string", length=50)
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Promocion", mappedBy="estadoPromocion")
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
     * @return EstadoPromocion
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

    /**
     * Add promociones
     *
     * @param \AppBundle\Entity\Promocion $promociones
     * @return EstadoPromocion
     */
    public function addPromocione(\AppBundle\Entity\Promocion $promociones)
    {
        $this->promociones[] = $promociones;

        return $this;
    }

    /**
     * Remove promociones
     *
     * @param \AppBundle\Entity\Promocion $promociones
     */
    public function removePromocione(\AppBundle\Entity\Promocion $promociones)
    {
        $this->promociones->removeElement($promociones);
    }

    /**
     * Get promociones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPromociones()
    {
        return $this->promociones;
    }
}
