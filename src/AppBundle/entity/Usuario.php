<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UsuarioRepository")
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=255)
     */
    private $usuario;
    
    /**
    * @ORM\OneToOne(targetEntity="UsuarioMovil", mappedBy="usuario")
    */
    private $usuarioMovil;
    
    /**
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="usuarios")
     * @ORM\JoinColumn(name="idRol", referencedColumnName="idRol")
     */
    protected $rol;

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return Usuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
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
     * @return Usuario
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
     * Set usuarioMovil
     *
     * @param \AppBundle\Entity\UsuarioMovil $usuarioMovil
     * @return Usuario
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
     * Set rol
     *
     * @param \AppBundle\Entity\Rol $rol
     * @return Usuario
     */
    public function setRol(\AppBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \AppBundle\Entity\Rol 
     */
    public function getRol()
    {
        return $this->rol;
    }
}
