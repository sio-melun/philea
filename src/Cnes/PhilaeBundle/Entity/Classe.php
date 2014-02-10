<?php

namespace Cnes\PhilaeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Classe
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
     * @ORM\Column(name="nomcourt", type="string", length=40)
     */
    private $nomcourt;

    /**
     * @var string
     *
     * @ORM\Column(name="nomlong", type="string", length=150)
     */
    private $nomlong;

    /**
     * @var string
     *
     * @ORM\Column(name="discipline", type="string", length=100)
     */
    private $discipline;


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
     * Set nomcourt
     *
     * @param string $nomcourt
     * @return Classe
     */
    public function setNomcourt($nomcourt)
    {
        $this->nomcourt = $nomcourt;
    
        return $this;
    }

    /**
     * Get nomcourt
     *
     * @return string 
     */
    public function getNomcourt()
    {
        return $this->nomcourt;
    }

    /**
     * Set nomlong
     *
     * @param string $nomlong
     * @return Classe
     */
    public function setNomlong($nomlong)
    {
        $this->nomlong = $nomlong;
    
        return $this;
    }

    /**
     * Get nomlong
     *
     * @return string 
     */
    public function getNomlong()
    {
        return $this->nomlong;
    }

    /**
     * Set discipline
     *
     * @param string $discipline
     * @return Classe
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;
    
        return $this;
    }

    /**
     * Get discipline
     *
     * @return string 
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }
}