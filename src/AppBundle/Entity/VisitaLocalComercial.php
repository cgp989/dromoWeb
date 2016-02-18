<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * VisitaLocalComercial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VisitaLocalComercialRepository")
 * 
 * @ExclusionPolicy("all")
 */
class VisitaLocalComercial {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS96-visita"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     * 
     * @Expose
     * @Groups({"serviceUSS96-visita"})
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="LocalComercial", inversedBy="visitasLocalComercial")
     * @ORM\JoinColumn(name="idLocalComercial", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS96-visita"})
     * 
     */
    private $localComercial;

    /**
     * @ORM\ManyToOne(targetEntity="UsuarioMovil", inversedBy="visitasLocalComercial")
     * @ORM\JoinColumn(name="idUsuarioMovil", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS96-visita"})
     * 
     */
    private $usuarioMovil;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return VisitaLocalComercial
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set localComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return VisitaLocalComercial
     */
    public function setLocalComercial(\AppBundle\Entity\LocalComercial $localComercial = null) {
        $this->localComercial = $localComercial;

        return $this;
    }

    /**
     * Get localComercial
     *
     * @return \AppBundle\Entity\LocalComercial 
     */
    public function getLocalComercial() {
        return $this->localComercial;
    }

    /**
     * Set usuarioMovil
     *
     * @param \AppBundle\Entity\UsuarioMovil $usuarioMovil
     * @return VisitaLocalComercial
     */
    public function setUsuarioMovil(\AppBundle\Entity\UsuarioMovil $usuarioMovil = null) {
        $this->usuarioMovil = $usuarioMovil;

        return $this;
    }

    /**
     * Get usuarioMovil
     *
     * @return \AppBundle\Entity\UsuarioMovil 
     */
    public function getUsuarioMovil() {
        return $this->usuarioMovil;
    }

}
