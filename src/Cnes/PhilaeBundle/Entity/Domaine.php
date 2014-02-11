<?php

namespace Cnes\PhilaeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domaine
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Domaine
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
     * @ORM\Column(name="nom", type="string", length=30)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1024)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="typeDomaine", type="string", length=50)
     */
    private $typeDomaine;
    
    /**
    * @ORM\OneToMany(targetEntity="Cnes\PhilaeBundle\Entity\Projet", mappedBy="domaine")
    */
    private $projets;

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
     * @return Domaine
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
     * Set description
     *
     * @param string $description
     * @return Domaine
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Domaine
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set typeDomaine
     *
     * @param string $typeDomaine
     * @return Domaine
     */
    public function setTypeDomaine($typeDomaine)
    {
        $this->typeDomaine = $typeDomaine;
    
        return $this;
    }

    /**
     * Get typeDomaine
     *
     * @return string 
     */
    public function getTypeDomaine()
    {
        return $this->typeDomaine;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projets = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add projets
     *
     * @param \Cnes\PhilaeBundle\Entity\Projet $projets
     * @return Domaine
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