<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cobro
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CobroRepository")
 */
class Cobro
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="idUsuarioAdmin", referencedColumnName="id")
     */
    private $userAdmin;

    /**
     * @ORM\ManyToOne(targetEntity="LocalComercial", inversedBy="cobros")
     * @ORM\JoinColumn(name="idLocalComercial", referencedColumnName="id")
     */
    private $localComercial;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;
    
    /**
     * @ORM\OneToMany(targetEntity="Cupon", mappedBy="cobro")
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Cobro
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
     * Set userAdmin
     *
     * @param \stdClass $userAdmin
     * @return Cobro
     */
    public function setUserAdmin($userAdmin)
    {
        $this->userAdmin = $userAdmin;

        return $this;
    }

    /**
     * Get userAdmin
     *
     * @return \stdClass 
     */
    public function getUserAdmin()
    {
        return $this->userAdmin;
    }

    /**
     * Set localComercial
     *
     * @param \stdClass $localComercial
     * @return Cobro
     */
    public function setLocalComercial($localComercial)
    {
        $this->localComercial = $localComercial;

        return $this;
    }

    /**
     * Get localComercial
     *
     * @return \stdClass 
     */
    public function getLocalComercial()
    {
        return $this->localComercial;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Cobro
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Add cupones
     *
     * @param \AppBundle\Entity\Cupon $cupones
     * @return Cobro
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
