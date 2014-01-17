<?php

namespace Cnes\PhilaeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Avancement
 *
 * @ORM\Table(name="Avancement")
 * @ORM\Entity(repositoryClass="Cnes\PhilaeBundle\Entity\AvancementRepository")
 */
class Avancement {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="idProjet", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $idProjet;
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="Avancement", type="integer")
	 */
	private $Avancement;




     /**
     * Get idProjet
     *
     * @return integer 
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

     /**
     * Get Avancement
     *
     * @return integer
     */
    public function getAvancement()
    {
        return $this->Avancement;
    }




    /**
     * Set Avancement
     *
     * @param \integer $Avancement
     * @return Avancement
     */
    public function setAvancement(\integer $Avancement)
    {
        $this->Avancement = $Avancement;
    
        return $this;
    }
}