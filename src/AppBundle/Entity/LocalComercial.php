<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JeroenDesloovere\Distance\Distance;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * LocalComercial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\LocalComercialRepository")
 * 
 * @ExclusionPolicy("all")
 */
class LocalComercial {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS013", "serviceUSS23", "serviceUSS02-login", "serviceUSS19-version", "serviceUSS06", "serviceCupones", "serviceUSS04-cuenta"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * 
     * @Expose
     * @Groups({"serviceUSS013", "serviceUSS23", "serviceUSS06", "serviceCupones", "serviceUSS04-cuenta"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     * @Expose
     * @Groups({"serviceUSS23", "serviceUSS06"})
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
     * @var integer
     *
     * @ORM\Column(name="version", type="integer")
     * 
     * @Expose
     * @Groups({"serviceUSS013", "serviceUSS23", "serviceUSS02-login", "serviceUSS19-version", "serviceUSS06","serviceCupones"})
     */
    private $version;

    /**
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="localComercial")
     * @ORM\JoinColumn(name="idUsuario", referencedColumnName="id")
     * 
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="Sucursal", mappedBy="localComercial")
     */
    private $sucursales;

    /**
     * @ORM\OneToMany(targetEntity="Promocion", mappedBy="localComercial")
     */
    private $promociones;

    /**
     * @ORM\Column(name="valoracion", type="float")
     * 
     * @Expose
     * @Groups({"serviceUSS23", "serviceUSS06"})
     */
    private $valoracion;

    /**
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="localComercial")
     */
    private $comentarios;

    /**
     * @ORM\OneToMany(targetEntity="Suscripcion", mappedBy="localComercial")
     */
    private $suscripciones;

    /**
     * @ORM\OneToMany(targetEntity="VisitaLocalComercial", mappedBy="localComercial")
     */
    private $visitasLocalComercial;

    public function __construct() {
        $this->sucursales = new ArrayCollection();
        $this->promociones = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->suscripciones = new ArrayCollection();
        $this->visitasLocalComercial = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return LocalComercial
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return LocalComercial
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set nombreContacto
     *
     * @param string $nombreContacto
     * @return LocalComercial
     */
    public function setNombreContacto($nombreContacto) {
        $this->nombreContacto = $nombreContacto;

        return $this;
    }

    /**
     * Get nombreContacto
     *
     * @return string 
     */
    public function getNombreContacto() {
        return $this->nombreContacto;
    }

    /**
     * Set emailContacto
     *
     * @param string $emailContacto
     * @return LocalComercial
     */
    public function setEmailContacto($emailContacto) {
        $this->emailContacto = $emailContacto;

        return $this;
    }

    /**
     * Get emailContacto
     *
     * @return string 
     */
    public function getEmailContacto() {
        return $this->emailContacto;
    }

    /**
     * Set telefonoContacto
     *
     * @param string $telefonoContacto
     * @return LocalComercial
     */
    public function setTelefonoContacto($telefonoContacto) {
        $this->telefonoContacto = $telefonoContacto;

        return $this;
    }

    /**
     * Get telefonoContacto
     *
     * @return string 
     */
    public function getTelefonoContacto() {
        return $this->telefonoContacto;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return LocalComercial
     */
    public function setVersion($version) {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     * @return LocalComercial
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Add sucursales
     *
     * @param \AppBundle\Entity\Sucursal $sucursales
     * @return LocalComercial
     */
    public function addSucursale(\AppBundle\Entity\Sucursal $sucursales) {
        $this->sucursales[] = $sucursales;

        return $this;
    }

    /**
     * Remove sucursales
     *
     * @param \AppBundle\Entity\Sucursal $sucursales
     */
    public function removeSucursale(\AppBundle\Entity\Sucursal $sucursales) {
        $this->sucursales->removeElement($sucursales);
    }

    /**
     * Get sucursales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSucursales() {
        return $this->sucursales;
    }

    /**
     * 
     * @param decimal $latitudUsuario
     * @param decimal $longitudUsuario
     * 
     * @return array [title][distance]
     */
    public function getSucursalMinimaDistancia($latitudUsuario, $longitudUsuario) {
        $arraySucursales;
        foreach ($this->getSucursales() as $sucursal) {
            $arraySucursales[] = array(
                'title' => $sucursal,
                'latitude' => $sucursal->getDireccion()->getLatitud(),
                'longitude' => $sucursal->getDireccion()->getLongitud()
            );
        }
        $distance = Distance::getClosest($latitudUsuario, $longitudUsuario, $arraySucursales, 3);
        //print_r($distance);
        return $distance;
    }

    public function getComentariosOrdenados() {
        $arrayComentarios = $this->comentarios->toArray();
        usort($arrayComentarios, function(Comentario $a, Comentario $b) {
            return $a->compareTo($b);
        }
        );
        return $arrayComentarios;
    }

    /**
     * Add promociones
     *
     * @param \AppBundle\Entity\Promocion $promociones
     * @return LocalComercial
     */
    public function addPromocione(\AppBundle\Entity\Promocion $promociones) {
        $this->promociones[] = $promociones;

        return $this;
    }

    /**
     * Remove promociones
     *
     * @param \AppBundle\Entity\Promocion $promociones
     */
    public function removePromocione(\AppBundle\Entity\Promocion $promociones) {
        $this->promociones->removeElement($promociones);
    }

    /**
     * Get promociones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPromociones() {
        return $this->promociones;
    }

    /**
     * Set valoracion
     *
     * @param float $valoracion
     * @return LocalComercial
     */
    public function setValoracion($valoracion) {
        $this->valoracion = $valoracion;

        return $this;
    }

    /**
     * Get valoracion
     *
     * @return float 
     */
    public function getValoracion() {
        return $this->valoracion;
    }

    /**
     * Add comentarios
     *
     * @param \AppBundle\Entity\Comentario $comentarios
     * @return LocalComercial
     */
    public function addComentario(\AppBundle\Entity\Comentario $comentarios) {
        $this->comentarios[] = $comentarios;

        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \AppBundle\Entity\Comentario $comentarios
     */
    public function removeComentario(\AppBundle\Entity\Comentario $comentarios) {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarios() {
        return $this->comentarios;
    }

    /**
     * Add suscripciones
     *
     * @param \AppBundle\Entity\Suscripcion $suscripciones
     * @return LocalComercial
     */
    public function addSuscripcione(\AppBundle\Entity\Suscripcion $suscripciones) {
        $this->suscripciones[] = $suscripciones;

        return $this;
    }

    /**
     * Remove suscripciones
     *
     * @param \AppBundle\Entity\Suscripcion $suscripciones
     */
    public function removeSuscripcione(\AppBundle\Entity\Suscripcion $suscripciones) {
        $this->suscripciones->removeElement($suscripciones);
    }

    /**
     * Get suscripciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuscripciones() {
        return $this->suscripciones;
    }

    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Add visitasLocalComercial
     *
     * @param \AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial
     * @return LocalComercial
     */
    public function addVisitasLocalComercial(\AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial) {
        $this->visitasLocalComercial[] = $visitasLocalComercial;

        return $this;
    }

    /**
     * Remove visitasLocalComercial
     *
     * @param \AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial
     */
    public function removeVisitasLocalComercial(\AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial) {
        $this->visitasLocalComercial->removeElement($visitasLocalComercial);
    }

    /**
     * Get visitasLocalComercial
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisitasLocalComercial() {
        return $this->visitasLocalComercial;
    }

}
