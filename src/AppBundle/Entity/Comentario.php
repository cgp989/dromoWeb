<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Comentario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ComentarioRepository")
 * 
 * @ExclusionPolicy("all")
 */
class Comentario {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     * 
     * @Expose
     * @Groups({"serviceUSS23-comentarios"})
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=255)
     * 
     * @Expose
     * @Groups({"serviceUSS23-comentarios"})
     */
    private $comentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="valoracion", type="integer")
     * 
     * @Expose
     * @Groups({"serviceUSS23-comentarios"})
     */
    private $valoracion;

    /**
     * @ORM\ManyToOne(targetEntity="EstadoComentario", inversedBy="comentarios")
     * @ORM\JoinColumn(name="idEstadoComentario", referencedColumnName="id")
     */
    private $estadoComentario;

    /**
     * @ORM\ManyToOne(targetEntity="UsuarioMovil", inversedBy="comentarios")
     * @ORM\JoinColumn(name="idUsuarioMovil", referencedColumnName="id")
     * 
     * @Expose
     * @Groups({"serviceUSS23-comentarios"})
     */
    private $usuarioMovil;

    /**
     * @ORM\ManyToOne(targetEntity="LocalComercial", inversedBy="comentarios")
     * @ORM\JoinColumn(name="idLocalComercial", referencedColumnName="id")
     */
    private $localComercial;

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
     * @return Comentario
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
     * Set comentario
     *
     * @param string $comentario
     * @return Comentario
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario() {
        return $this->comentario;
    }

    /**
     * Set valoracion
     *
     * @param integer $valoracion
     * @return Comentario
     */
    public function setValoracion($valoracion) {
        $this->valoracion = $valoracion;

        return $this;
    }

    /**
     * Get valoracion
     *
     * @return integer 
     */
    public function getValoracion() {
        return $this->valoracion;
    }

    /**
     * Set estadoComentario
     *
     * @param \AppBundle\Entity\EstadoComentario $estadoComentario
     * @return Comentario
     */
    public function setEstadoComentario(\AppBundle\Entity\EstadoComentario $estadoComentario = null) {
        $this->estadoComentario = $estadoComentario;

        return $this;
    }

    /**
     * Get estadoComentario
     *
     * @return \AppBundle\Entity\EstadoComentario 
     */
    public function getEstadoComentario() {
        return $this->estadoComentario;
    }

    /**
     * Set usuarioMovil
     *
     * @param \AppBundle\Entity\UsuarioMovil $usuarioMovil
     * @return Comentario
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

    /**
     * Set localComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return Comentario
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
     * Retorna la fecha formateada
     * 
     * @return String
     * @VirtualProperty 
     * @Groups({"serviceUSS23-comentarios"})
     */
    public function getFecha_() {
        return $this->fecha->format("Y-m-d H:m:s");
    }

    /**
     * compareTo
     *
     * 
     * @return integer
     */
    public function compareTo(Comentario $comentario) {
        if ($this->getFecha() < $comentario->getFecha())
            return 1;
        else if ($this->getFecha() > $comentario->getFecha())
            return -1;
        else
            return 0;
    }

}
