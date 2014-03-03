<?php

namespace Cnes\PhileaBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser {

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
    protected $nom;

    /**
     * @ORM\ManyToMany(targetEntity="Cnes\PhileaBundle\Entity\Projet", cascade={"persist"}, inversedBy="users")
     */
    protected $projets;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->roles = array('ROLE_REDACTEUR');
        $this->projets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Add projets
     *
     * @param \Cnes\PhileaBundle\Entity\Projet $projet
     * @return User
     */
    public function addProjet(\Cnes\PhileaBundle\Entity\Projet $projet) {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projets
     *
     * @param \Cnes\PhileaBundle\Entity\Projet $projet
     */
    public function removeProjet(\Cnes\PhileaBundle\Entity\Projet $projet) {
        $this->projets->removeElement($projet);
    }

    /**
     * Get projets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjets() {
        return $this->projets;
    }

    public function toString(){
        return $this->usernameCanonical;
    }
}