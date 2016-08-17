<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Totales
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TotalesRepository")
 */
class Totales
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
     * @ORM\Column(name="totalCobroLocales", type="float")
     */
    private $totalCobroLocales;

    /**
     * @var float
     *
     * @ORM\Column(name="totalGanancia", type="float")
     */
    private $totalGanancia;

    /**
     * @var float
     *
     * @ORM\Column(name="totalParaPremios", type="float")
     */
    private $totalParaPremios;

    /**
     * @var float
     *
     * @ORM\Column(name="totalGastadoPremios", type="float")
     */
    private $totalGastadoPremios;


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
     * Set totalCobroLocales
     *
     * @param float $totalCobroLocales
     * @return Totales
     */
    public function setTotalCobroLocales($totalCobroLocales)
    {
        $this->totalCobroLocales = $totalCobroLocales;

        return $this;
    }

    /**
     * Get totalCobroLocales
     *
     * @return float 
     */
    public function getTotalCobroLocales()
    {
        return $this->totalCobroLocales;
    }

    /**
     * Set totalGanancia
     *
     * @param float $totalGanancia
     * @return Totales
     */
    public function setTotalGanancia($totalGanancia)
    {
        $this->totalGanancia = $totalGanancia;

        return $this;
    }

    /**
     * Get totalGanancia
     *
     * @return float 
     */
    public function getTotalGanancia()
    {
        return $this->totalGanancia;
    }

    /**
     * Set totalParaPremios
     *
     * @param float $totalParaPremios
     * @return Totales
     */
    public function setTotalParaPremios($totalParaPremios)
    {
        $this->totalParaPremios = $totalParaPremios;

        return $this;
    }

    /**
     * Get totalParaPremios
     *
     * @return float 
     */
    public function getTotalParaPremios()
    {
        return $this->totalParaPremios;
    }

    /**
     * Set totalGastadoPremios
     *
     * @param float $totalGastadoPremios
     * @return Totales
     */
    public function setTotalGastadoPremios($totalGastadoPremios)
    {
        $this->totalGastadoPremios = $totalGastadoPremios;

        return $this;
    }

    /**
     * Get totalGastadoPremios
     *
     * @return float 
     */
    public function getTotalGastadoPremios()
    {
        return $this->totalGastadoPremios;
    }
}
