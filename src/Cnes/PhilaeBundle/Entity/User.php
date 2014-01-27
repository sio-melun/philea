<?php
// src/Cnes/PhilaeBundle/Entity/User.php

namespace Cnes\PhilaeBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
  	protected $id;
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Nom", type="string", length=25 , nullable=true)
	 */
  	private $nom;
    /**
     * @ORM\ManyToMany(targetEntity="Cnes\PhilaeBundle\Entity\Projet", cascade={"persist"})
     */
    private $projets;
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->projets = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Add projets
     *
     * @param \Cnes\PhilaeBundle\Entity\Projet $projets
     * @return User
     */
    public function addProjet(\Cnes\PhilaeBundle\Entity\Projet $projets)
    {
        $this->projets[] = $projets;
    
        return $this;
    }

    /**
     * Remove projets
     *
     * @param \Cnes\PhilaeBundle\Entity\Projet $projets
     */
    public function removeProjet(\Cnes\PhilaeBundle\Entity\Projet $projets)
    {
        $this->projets->removeElement($projets);
    }

    /**
     * Get projets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjets()
    {
        return $this->projets;
    }
}