<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoCupon
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TipoCuponRepository")
 */
class TipoCupon
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Cupon", mappedBy="tipoCupon")
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
     * @return TipoCupon
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
     * @param \AppBundle\Entity\cupon $cupones
     * @return TipoCupon
     */
    public function addCupone(\AppBundle\Entity\cupon $cupones)
    {
        $this->cupones[] = $cupones;

        return $this;
    }

    /**
     * Remove cupones
     *
     * @param \AppBundle\Entity\cupon $cupones
     */
    public function removeCupone(\AppBundle\Entity\cupon $cupones)
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
