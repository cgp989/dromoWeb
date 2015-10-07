<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sucursal
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SucursalRepository")
 */
class Sucursal
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
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;
    
    /**
     * @ORM\OneToOne(targetEntity="Direccion", inversedBy="sucursal")
     * @ORM\JoinColumn(name="idDireccion", referencedColumnName="id")
     */
    private $direccion;
    
    /**
     * @ORM\ManyToOne(targetEntity="LocalComercial", inversedBy="sucursales")
     * @ORM\JoinColumn(name="idLocalComercial", referencedColumnName="id")
     */
    private $localComercial;

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
     * Set telefono
     *
     * @param string $telefono
     * @return Sucursal
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set direccion
     *
     * @param \AppBundle\Entity\Direccion $direccion
     * @return Sucursal
     */
    public function setDireccion(\AppBundle\Entity\Direccion $direccion = null)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return \AppBundle\Entity\Direccion 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set LocalComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return Sucursal
     */
    public function setLocalComercial(\AppBundle\Entity\LocalComercial $localComercial = null)
    {
        $this->localComercial = $localComercial;

        return $this;
    }

    /**
     * Get LocalComercial
     *
     * @return \AppBundle\Entity\LocalComercial 
     */
    public function getLocalComercial()
    {
        return $this->localComercial;
    }
}
