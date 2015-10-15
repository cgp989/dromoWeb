<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * EstadoProgramacionEnDia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EstadoProgramacionEnDiaRepository")
 * @ExclusionPolicy("all")
 */
class EstadoProgramacionEnDia
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
     * @Expose
     * @Groups({"serviceUSS013"})
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="ProgramacionEnDia", mappedBy="estadoProgramacionEnDia")
     */
    private $programacionesEnDia;
    
    public function __construct() {
       $this->programacionesEnDia = new ArrayCollection();
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
     * @return EstadoProgramacionEnDia
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
     * Add programacionesEnDia
     *
     * @param \AppBundle\Entity\ProgramacionEnDia $programacionesEnDia
     * @return EstadoProgramacionEnDia
     */
    public function addProgramacionesEnDium(\AppBundle\Entity\ProgramacionEnDia $programacionesEnDia)
    {
        $this->programacionesEnDia[] = $programacionesEnDia;

        return $this;
    }

    /**
     * Remove programacionesEnDia
     *
     * @param \AppBundle\Entity\ProgramacionEnDia $programacionesEnDia
     */
    public function removeProgramacionesEnDium(\AppBundle\Entity\ProgramacionEnDia $programacionesEnDia)
    {
        $this->programacionesEnDia->removeElement($programacionesEnDia);
    }

    /**
     * Get programacionesEnDia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgramacionesEnDia()
    {
        return $this->programacionesEnDia;
    }
}
