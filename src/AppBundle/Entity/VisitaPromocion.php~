<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * VisitaPromocion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VisitaPromocionRepository")
 * 
 *  @ExclusionPolicy("all")
 */
class VisitaPromocion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS17-visita"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     * 
     * @Expose
     * @Groups({"serviceUSS17-visita"})
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Programacion", inversedBy="visitasPromocion")
     * @ORM\JoinColumn(name="idProgramacion", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS17-visita"})
     */
    private $programacion;

    /**
     * @ORM\ManyToOne(targetEntity="UsuarioMovil", inversedBy="visitasPromocion")
     * @ORM\JoinColumn(name="idUsuarioMovil", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS17-visita"})
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
     * @return VisitaPromocion
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
     * Set programacion
     *
     * @param \AppBundle\Entity\Programacion $programacion
     * @return VisitaPromocion
     */
    public function setProgramacion(\AppBundle\Entity\Programacion $programacion = null) {
        $this->programacion = $programacion;

        return $this;
    }

    /**
     * Get programacion
     *
     * @return \AppBundle\Entity\Programacion 
     */
    public function getProgramacion() {
        return $this->programacion;
    }

    /**
     * Set usuarioMovil
     *
     * @param \AppBundle\Entity\UsuarioMovil $usuarioMovil
     * @return VisitaPromocion
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
