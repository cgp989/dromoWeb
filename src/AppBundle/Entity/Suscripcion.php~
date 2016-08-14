<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Suscripcion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SuscripcionRepository")
 * 
 * @ExclusionPolicy("all")
 */
class Suscripcion
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
     * @var boolean
     *
     * @ORM\Column(name="notificaciones", type="boolean")
     * @Expose
     * @Groups({"serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $notificaciones;
    
    /**
     * @ORM\ManyToOne(targetEntity="LocalComercial", inversedBy="suscripciones")
     * @ORM\JoinColumn(name="idLocalComercial", referencedColumnName="id")
     * @Expose
     * @Groups({"serviceUSS02-login", "serviceUSS04-cuenta"})
     */
    private $localComercial;
    
    /**
     * @ORM\ManyToOne(targetEntity="UsuarioMovil", inversedBy="suscripciones")
     * @ORM\JoinColumn(name="idUsuarioMovil", referencedColumnName="id")
     */
    private $usuarioMovil;


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
     * Set notificaciones
     *
     * @param boolean $notificaciones
     * @return Suscripcion
     */
    public function setNotificaciones($notificaciones)
    {
        $this->notificaciones = $notificaciones;
        
        return $this;
    }

    /**
     * Get notificaciones
     *
     * @return boolean 
     */
    public function getNotificaciones()
    {
        return $this->notificaciones;
    }

    /**
     * Set localComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return Suscripcion
     */
    public function setLocalComercial(\AppBundle\Entity\LocalComercial $localComercial = null)
    {
        $this->localComercial = $localComercial;

        return $this;
    }

    /**
     * Get localComercial
     *
     * @return \AppBundle\Entity\LocalComercial 
     */
    public function getLocalComercial()
    {
        return $this->localComercial;
    }

    /**
     * Set usuarioMovil
     *
     * @param \AppBundle\Entity\UsuarioMovil $usuarioMovil
     * @return Suscripcion
     */
    public function setUsuarioMovil(\AppBundle\Entity\UsuarioMovil $usuarioMovil = null)
    {
        $this->usuarioMovil = $usuarioMovil;

        return $this;
    }

    /**
     * Get usuarioMovil
     *
     * @return \AppBundle\Entity\UsuarioMovil 
     */
    public function getUsuarioMovil()
    {
        return $this->usuarioMovil;
    }
}
