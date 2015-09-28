<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JeroenDesloovere\Distance\Distance;
/**
 * LocalComercial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\LocalComercialRepository")
 */
class LocalComercial
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreContacto", type="string", length=255)
     */
    private $nombreContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="emailContacto", type="string", length=255)
     */
    private $emailContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoContacto", type="string", length=255)
     */
    private $telefonoContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer")
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     */
    private $imagen;

    /**
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="localComercial")
     * @ORM\JoinColumn(name="idUsuario", referencedColumnName="id")
     */
    private $usuario;
    
    /**
     * @ORM\OneToMany(targetEntity="Sucursal", mappedBy="localComercial")
     */
    private $sucursales;

    public function __construct()
    {
        $this->sucursales = new ArrayCollection();
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
     * @return LocalComercial
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return LocalComercial
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
     * Set nombreContacto
     *
     * @param string $nombreContacto
     * @return LocalComercial
     */
    public function setNombreContacto($nombreContacto)
    {
        $this->nombreContacto = $nombreContacto;

        return $this;
    }

    /**
     * Get nombreContacto
     *
     * @return string 
     */
    public function getNombreContacto()
    {
        return $this->nombreContacto;
    }

    /**
     * Set emailContacto
     *
     * @param string $emailContacto
     * @return LocalComercial
     */
    public function setEmailContacto($emailContacto)
    {
        $this->emailContacto = $emailContacto;

        return $this;
    }

    /**
     * Get emailContacto
     *
     * @return string 
     */
    public function getEmailContacto()
    {
        return $this->emailContacto;
    }

    /**
     * Set telefonoContacto
     *
     * @param string $telefonoContacto
     * @return LocalComercial
     */
    public function setTelefonoContacto($telefonoContacto)
    {
        $this->telefonoContacto = $telefonoContacto;

        return $this;
    }

    /**
     * Get telefonoContacto
     *
     * @return string 
     */
    public function getTelefonoContacto()
    {
        return $this->telefonoContacto;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return LocalComercial
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return LocalComercial
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return LocalComercial
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     * @return LocalComercial
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add sucursales
     *
     * @param \AppBundle\Entity\Sucursal $sucursales
     * @return LocalComercial
     */
    public function addSucursale(\AppBundle\Entity\Sucursal $sucursales)
    {
        $this->sucursales[] = $sucursales;

        return $this;
    }

    /**
     * Remove sucursales
     *
     * @param \AppBundle\Entity\Sucursal $sucursales
     */
    public function removeSucursale(\AppBundle\Entity\Sucursal $sucursales)
    {
        $this->sucursales->removeElement($sucursales);
    }

    /**
     * Get sucursales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSucursales()
    {
        return $this->sucursales;
    }
    
    /**
     * 
     * @param decimal $latitudUsuario
     * @param decimal $longitudUsuario
     * 
     * @return array [title][distance]
     */
    public function getSucursalMinimaDistancia($latitudUsuario, $longitudUsuario){
        $arraySucursales;
        foreach ($this->getSucursales() as $sucursal) {
            $arraySucursales[] =
                    array(
                        'title' => $sucursal->getId(),
                        'latitude' => $sucursal->getDireccion()->getLatitud(),
                        'longitude' => $sucursal->getDireccion()->getLongitud()
                    );
        }
        $distance = Distance::getClosest($latitudUsuario, $longitudUsuario, $arraySucursales, 3);
        //print_r($distance);
        return $distance;
    }
}