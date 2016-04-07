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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\OneToOne(targetEntity="LocalComercial", mappedBy="usuario")
     */
    private $localComercial;
    
    /**
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="usuarios")
     * @ORM\JoinColumn(name="idRol", referencedColumnName="id")
     */
    protected $rol;

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
     * Set localComercial
     *
     * @param \AppBundle\Entity\LocalComercial $localComercial
     * @return Usuario
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
    
    public function __toString() {
      return $this->usuario;
   }
}
