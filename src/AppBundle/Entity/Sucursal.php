<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JeroenDesloovere\Distance\Distance;

/**
 * Sucursal
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SucursalRepository")
 * 
 * @ExclusionPolicy("all")
 */
class Sucursal {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS013", "serviceUSS013-sucursales","serviceUSS06"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     * @Expose
     * @Groups({"serviceUSS013-sucursales","serviceUSS06"})
     */
    private $telefono;

    /**
     * @ORM\OneToOne(targetEntity="Direccion", inversedBy="sucursal")
     * @ORM\JoinColumn(name="idDireccion", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS013", "serviceUSS013-sucursales","serviceUSS06"})
     */
    private $direccion;

    /**
     * @ORM\ManyToOne(targetEntity="LocalComercial", inversedBy="sucursales")
     * @ORM\JoinColumn(name="idLocalComercial", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS013","serviceUSS06"})
     */
    private $localComercial;

    /**
     * @Expose
     * @Groups({"serviceUSS013-sucursales","serviceUSS06"})
     */
    private $distanciaUsuarioMovil;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Sucursal
     */
    public function setTelefono($telefono) {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set direccion
     *
     * @param \AppBundle\Entity\Direccion $direccion
     * @return Sucursal
     */
    public function setDireccion(\AppBundle\Entity\Direccion $direccion = null) {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return \AppBundle\Entity\Direccion 
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set LocalComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return Sucursal
     */
    public function setLocalComercial(\AppBundle\Entity\LocalComercial $localComercial = null) {
        $this->localComercial = $localComercial;

        return $this;
    }

    /**
     * Get LocalComercial
     *
     * @return \AppBundle\Entity\LocalComercial 
     */
    public function getLocalComercial() {
        return $this->localComercial;
    }

    public function getDistanciaUsuarioMovil() {
        return $this->distanciaUsuarioMovil;
    }

    public function setDistanciaUsuarioMovil($distanciaUsuarioMovil) {
        $this->distanciaUsuarioMovil = $distanciaUsuarioMovil;
    }

    public function calcularDistanciaAUsuarioMovil($latitud, $longitud) {
        $distancia = Distance::between(
                        $latitud, $longitud, $this->getDireccion()->getLatitud(), $this->getDireccion()->getLongitud(), 3);
        $this->setDistanciaUsuarioMovil($distancia);
    }

    /**
     * compareTo
     *
     * @param Sucursal $otraSucursal
     * @return integer
     */
    public function compareTo(Sucursal $otraSucursal) {
        if ($this->getDistanciaUsuarioMovil() == $otraSucursal->getDistanciaUsuarioMovil())
            return 0;
        else if ($this->getDistanciaUsuarioMovil() > $otraSucursal->getDistanciaUsuarioMovil())
            return 1;
        else if ($this->getDistanciaUsuarioMovil() < $otraSucursal->getDistanciaUsuarioMovil())
            return -1;
    }    

    public function __toString() {
       return $this->telefono;
    }

}
