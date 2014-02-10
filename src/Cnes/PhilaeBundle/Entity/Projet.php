<?php

namespace Cnes\PhilaeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Projet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Domaine")
     * @ORM\JoinColumn(nullable=true, name="idDomaine", referencedColumnName="id")
     */
    protected $domaine;

    /**
     * @ORM\ManyToOne(targetEntity="Etablissement")
     * @ORM\JoinColumn(nullable=true, name="idEtablissement", referencedColumnName="id")
     */
    protected $etablissement;

    /**
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumn(nullable=true, name="idClasse", referencedColumnName="id")
     */
    protected $classe;

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
     * Set domaine
     *
     * @param \Cnes\PhilaeBundle\Entity\Domaine $domaine
     * @return Projet
     */
    public function setDomaine(\Cnes\PhilaeBundle\Entity\Domaine $domaine = null)
    {
        $this->domaine = $domaine;
    
        return $this;
    }

    /**
     * Get domaine
     *
     * @return \Cnes\PhilaeBundle\Entity\Domaine 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Set etablissement
     *
     * @param \Cnes\PhilaeBundle\Entity\Etablissement $etablissement
     * @return Projet
     */
    public function setEtablissement(\Cnes\PhilaeBundle\Entity\Etablissement $etablissement = null)
    {
        $this->etablissement = $etablissement;
    
        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \Cnes\PhilaeBundle\Entity\Etablissement 
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set classe
     *
     * @param \Cnes\PhilaeBundle\Entity\Classe $classe
     * @return Projet
     */
    public function setClasse(\Cnes\PhilaeBundle\Entity\Classe $classe = null)
    {
        $this->classe = $classe;
    
        return $this;
    }

    /**
     * Get classe
     *
     * @return \Cnes\PhilaeBundle\Entity\Classe 
     */
    public function getClasse()
    {
        return $this->classe;
    }

}