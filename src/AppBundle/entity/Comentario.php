<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comentario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ComentarioRepository")
 */
class Comentario
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
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=255)
     */
    private $comentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="valoracion", type="integer")
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comentario
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
     * Set comentario
     *
     * @param string $comentario
     * @return Comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set valoracion
     *
     * @param integer $valoracion
     * @return Comentario
     */
    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    /**
     * Get valoracion
     *
     * @return integer 
     */
    public function getValoracion()
    {
        return $this->valoracion;
    }

    /**
     * Set estadoComentario
     *
     * @param \AppBundle\Entity\EstadoComentario $estadoComentario
     * @return Comentario
     */
    public function setEstadoComentario(\AppBundle\Entity\EstadoComentario $estadoComentario = null)
    {
        $this->estadoComentario = $estadoComentario;

        return $this;
    }

    /**
     * Get estadoComentario
     *
     * @return \AppBundle\Entity\EstadoComentario 
     */
    public function getEstadoComentario()
    {
        return $this->estadoComentario;
    }

    /**
     * Set usuarioMovil
     *
     * @param \AppBundle\Entity\UsuarioMovil $usuarioMovil
     * @return Comentario
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

    /**
     * Set localComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return Comentario
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
}
