<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * UsuarioMovil
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UsuarioMovilRepository")
 * 
 * @ExclusionPolicy("all")
 */
class UsuarioMovil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Cupon", mappedBy="usuarioMovil")
     *      
     */
    private $cupones;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     * @Expose
     * @Groups({"serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * 
     * @Expose
     * @Groups({"serviceUSS23-comentarios", "serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     * 
     * @Expose
     * @Groups({"serviceUSS23-comentarios", "serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $apellido;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntos", type="integer")
     */
    private $puntos;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=10)
     * @Expose
     * @Groups({"serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $sexo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Expose
     * @Groups({"serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=255)
     * @Expose
     * @Groups({"serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $usuario;
    
    /**
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="usuarioMovil")
     * 
     */
    private $comentarios;
    
    /**
     * @ORM\OneToMany(targetEntity="Suscripcion", mappedBy="usuarioMovil")
     * @Expose
     * @Groups({"serviceUSS02-login"})
     */
    private $suscripciones;
    
    /**
     * @ORM\OneToMany(targetEntity="VisitaPromocion", mappedBy="usuarioMovil")
     */
    private $visitasPromocion;
    
    /**
     * @ORM\OneToMany(targetEntity="VisitaLocalComercial", mappedBy="usuarioMovil")
     */
    private $visitasLocalComercial;
    
    public function __construct() {
        $this->comentarios = new ArrayCollection();
        $this->cupones = new ArrayCollection();
        $this->suscripciones = new ArrayCollection();
        $this->visitasPromocion = new ArrayCollection();
        $this->visitasLocalComercial = new ArrayCollection();
    }

    /*
     * mapear cuando este la entidad Suscripcion
    private $suscripciones;
|   */

        /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return UsuarioMovil
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return UsuarioMovil
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return UsuarioMovil
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
     * Set puntos
     *
     * @param integer $puntos
     * @return UsuarioMovil
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * Get puntos
     *
     * @return integer 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return UsuarioMovil
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }


    /**
     * Set apellido
     *
     * @param string $apellido
     * @return UsuarioMovil
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
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
     * Add cupones
     *
     * @param \AppBundle\Entity\Cupon $cupones
     * @return UsuarioMovil
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

    /**
     * Set password
     *
     * @param string $password
     * @return UsuarioMovil
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return UsuarioMovil
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add comentarios
     *
     * @param \AppBundle\Entity\Comentario $comentarios
     * @return UsuarioMovil
     */
    public function addComentario(\AppBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios[] = $comentarios;

        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \AppBundle\Entity\Comentario $comentarios
     */
    public function removeComentario(\AppBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Add suscripciones
     *
     * @param \AppBundle\Entity\Suscripcion $suscripciones
     * @return UsuarioMovil
     */
    public function addSuscripcione(\AppBundle\Entity\Suscripcion $suscripciones)
    {
        $this->suscripciones[] = $suscripciones;

        return $this;
    }

    /**
     * Remove suscripciones
     *
     * @param \AppBundle\Entity\Suscripcion $suscripciones
     */
    public function removeSuscripcione(\AppBundle\Entity\Suscripcion $suscripciones)
    {
        $this->suscripciones->removeElement($suscripciones);
    }

    /**
     * Get suscripciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuscripciones()
    {
        return $this->suscripciones;
    }

    /**
     * Add visitasPromocion
     *
     * @param \AppBundle\Entity\VisitaPromocion $visitasPromocion
     * @return UsuarioMovil
     */
    public function addVisitasPromocion(\AppBundle\Entity\VisitaPromocion $visitasPromocion)
    {
        $this->visitasPromocion[] = $visitasPromocion;

        return $this;
    }

    /**
     * Remove visitasPromocion
     *
     * @param \AppBundle\Entity\VisitaPromocion $visitasPromocion
     */
    public function removeVisitasPromocion(\AppBundle\Entity\VisitaPromocion $visitasPromocion)
    {
        $this->visitasPromocion->removeElement($visitasPromocion);
    }

    /**
     * Get visitasPromocion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisitasPromocion()
    {
        return $this->visitasPromocion;
    }

    /**
     * Add visitasLocalComercial
     *
     * @param \AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial
     * @return UsuarioMovil
     */
    public function addVisitasLocalComercial(\AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial)
    {
        $this->visitasLocalComercial[] = $visitasLocalComercial;

        return $this;
    }

    /**
     * Remove visitasLocalComercial
     *
     * @param \AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial
     */
    public function removeVisitasLocalComercial(\AppBundle\Entity\VisitaLocalComercial $visitasLocalComercial)
    {
        $this->visitasLocalComercial->removeElement($visitasLocalComercial);
    }

    /**
     * Get visitasLocalComercial
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisitasLocalComercial()
    {
        return $this->visitasLocalComercial;
    }
}
