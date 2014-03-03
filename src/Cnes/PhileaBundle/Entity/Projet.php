<?php

namespace Cnes\PhileaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cnes\PhileaBundle\Entity\ProjetRepository")
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
    * @ORM\OneToMany(targetEntity="Cnes\PhileaBundle\Entity\Etape", mappedBy="projet")
    */
    private $etapes;

    /**
     * @ORM\ManyToMany(targetEntity="Cnes\PhileaBundle\Entity\User", mappedBy="projets")
     **/
    private $users;


    public function __construct() {
        $this->etapes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set domaine
     *
     * @param \Cnes\PhileaBundle\Entity\Domaine $domaine
     * @return Projet
     */
    public function setDomaine(\Cnes\PhileaBundle\Entity\Domaine $domaine = null)
    {
        $this->domaine = $domaine;
    
        return $this;
    }

    /**
     * Get domaine
     *
     * @return \Cnes\PhileaBundle\Entity\Domaine 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Set etablissement
     *
     * @param \Cnes\PhileaBundle\Entity\Etablissement $etablissement
     * @return Projet
     */
    public function setEtablissement(\Cnes\PhileaBundle\Entity\Etablissement $etablissement = null)
    {
        $this->etablissement = $etablissement;
    
        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \Cnes\PhileaBundle\Entity\Etablissement 
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set classe
     *
     * @param \Cnes\PhileaBundle\Entity\Classe $classe
     * @return Projet
     */
    public function setClasse(\Cnes\PhileaBundle\Entity\Classe $classe = null)
    {
        $this->classe = $classe;
    
        return $this;
    }

    /**
     * Get classe
     *
     * @return \Cnes\PhileaBundle\Entity\Classe 
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Add etapes
     *
     * @param \Cnes\PhileaBundle\Entity\Etape $etapes
     * @return Projet
     */
    public function addEtape(\Cnes\PhileaBundle\Entity\Etape $etapes)
    {
        $this->etapes[] = $etapes;
    
        return $this;
    }

    /**
     * Remove etapes
     *
     * @param \Cnes\PhileaBundle\Entity\Etape $etapes
     */
    public function removeEtape(\Cnes\PhileaBundle\Entity\Etape $etapes)
    {
        $this->etapes->removeElement($etapes);
    }

    /**
     * Get etapes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtapes()
    {
        return $this->etapes;
    }


    /**
     * Add users
     *
     * @param \Cnes\PhileaBundle\Entity\User $users
     * @return Projet
     */
    public function addUser(\Cnes\PhileaBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Cnes\PhileaBundle\Entity\User $users
     */
    public function removeUser(\Cnes\PhileaBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    public function getAvancementMax() {
        $max = 0;
        foreach ($this->getEtapes() as $etape){
            if($etape->getAvancement()>$max)
                $max=$etape->getAvancement();
        }
        return $max;
    }


    public function getGestionnaires() {
        $gestionnaires = array();
        foreach ($this->getUsers() as $user){
            if($user && $user->getRoles()) {
               $r = $user->getRoles();
               if(in_array("ROLE_GESTIONNAIRE", $r))
                  $gestionnaires[] = $user;
            }
        }

        return $gestionnaires;
    }




}