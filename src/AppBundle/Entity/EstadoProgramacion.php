<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * EstadoProgramacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EstadoProgramacionRepository")
 */
class EstadoProgramacion
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
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Programacion", mappedBy="estadoProgramacion")
     */
    private $programaciones;
    
    public function __construct() {
        $this->programaciones = new ArrayCollection();
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
     * @return EstadoProgramacion
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
     * Add programaciones
     *
     * @param \AppBundle\Entity\Programacion $programaciones
     * @return EstadoProgramacion
     */
    public function addProgramacione(\AppBundle\Entity\Programacion $programaciones)
    {
        $this->programaciones[] = $programaciones;

        return $this;
    }

    /**
     * Remove programaciones
     *
     * @param \AppBundle\Entity\Programacion $programaciones
     */
    public function removeProgramacione(\AppBundle\Entity\Programacion $programaciones)
    {
        $this->programaciones->removeElement($programaciones);
    }

    /**
     * Get programaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgramaciones()
    {
        return $this->programaciones;
    }
    
    public function __toString() {
        return $this->getNombre();
    }
}
