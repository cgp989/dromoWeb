<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Variables
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VariablesRepository")
 */
class Variables
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
     * @var float
     *
     * @ORM\Column(name="porcCobroLocal", type="float")
     */
    private $porcCobroLocal;

    /**
     * @var float
     *
     * @ORM\Column(name="porcGanancia", type="float")
     */
    private $porcGanancia;

    /**
     * @var float
     *
     * @ORM\Column(name="valorPunto", type="float")
     */
    private $valorPunto;


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
     * Set porcCobroLocal
     *
     * @param float $porcCobroLocal
     * @return Variables
     */
    public function setPorcCobroLocal($porcCobroLocal)
    {
        $this->porcCobroLocal = $porcCobroLocal;

        return $this;
    }

    /**
     * Get porcCobroLocal
     *
     * @return float 
     */
    public function getPorcCobroLocal()
    {
        return $this->porcCobroLocal;
    }

    /**
     * Set porcGanancia
     *
     * @param float $porcGanancia
     * @return Variables
     */
    public function setPorcGanancia($porcGanancia)
    {
        $this->porcGanancia = $porcGanancia;

        return $this;
    }

    /**
     * Get porcGanancia
     *
     * @return float 
     */
    public function getPorcGanancia()
    {
        return $this->porcGanancia;
    }

    /**
     * Set valorPunto
     *
     * @param float $valorPunto
     * @return Variables
     */
    public function setValorPunto($valorPunto)
    {
        $this->valorPunto = $valorPunto;

        return $this;
    }

    /**
     * Get valorPunto
     *
     * @return float 
     */
    public function getValorPunto()
    {
        return $this->valorPunto;
    }
}
