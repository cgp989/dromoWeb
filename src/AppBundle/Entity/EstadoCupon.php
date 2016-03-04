<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * EstadoCupon
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EstadoCuponRepository")
 * 
 * @ExclusionPolicy("all")
 */
class EstadoCupon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS37"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     * 
     * @Expose
     * @Groups({"serviceUSS37"})
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Cupon", mappedBy="estadoCupon")
     * 
     * @Expose
     * @Groups({"serviceUSS37"})
     */
    private $cupones;
    
    public function __construct() {
        $this->cupones = new ArrayCollection();
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
     * @return EstadoCupon
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
     * Add cupones
     *
     * @param \AppBundle\Entity\Cupon $cupones
     * @return EstadoCupon
     */
    public function addCupone(\AppBundle\Entity\Cupon $cupones)
    {
        $this->cupones[] = $cupones;

        return $this;
    }

    /**
     * Remove cupones
     *
     * @param \AppBundle\Entity\Cupon $cupones
     */
    public function removeCupone(\AppBundle\Entity\Cupon $cupones)
    {
        $this->cupones->removeElement($cupones);
    }

    /**
     * Get cupones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCupones()
    {
        return $this->cupones;
    }
}
