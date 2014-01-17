<?php

namespace Cnes\PhilaeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etape
 *
 * @ORM\Table(name="Etape")
 * @ORM\Entity(repositoryClass="Cnes\PhilaeBundle\Entity\EtapeRepository")
 */
class Etape {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Titre", type="string", length=70)
	 */
	private $titre;
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Contenu", type="string")
	 */
	private $contenu;
	/**
	 * @var datetime
	 *
	 * @ORM\Column(name="Date", type="datetime")
	 */
	private $date;
	 /**
	 * @var string
	 *
	 * @ORM\Column(name="lienImage", type="string", length=60)
	 */
	private $lienImage;
	/**
	 * @var integer
	 * @ORM\OneToOne(targetEntity="User")
	 * @ORM\JoinColumn(nullable=true, name="Id",
	 referencedColumnName="id")
	 * @ORM\Column(name="idUser", type="integer", length=3)*/
    protected $idUser;
    /**
	 * @var integer
	 * @ORM\OneToOne(targetEntity="Projet")
	 * @ORM\JoinColumn(nullable=true, name="id",
	 referencedColumnName="id")
	 * @ORM\Column(name="idProjet", type="integer", length=3)
	 */
	protected $idProjet;


    /**
     * @var integer
     *
     * @ORM\Column(name="Avancement", type="integer", length=3)
     */
	private $avancement;
    
public function __construct()
{
    $this->date         = new \Datetime;

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
     * Set titre
     *
     * @param string $titre
     * @return Etape
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }
    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

	/**
     * Set contenu
     *
     * @param string $contenu
     * @return User
     */
    public function setName($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }
	/**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }



    /**
     * Get Date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

     /**
     * Get idUser
     *
     * @return \Cnes\PhilaeBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->id;
    }

	/**
     	* Get idProjet
     	*
     	* @return \Cnes\PhilaeBundle\Entity\Projet
     	*/
   	 public function getIdProjet()
    	{
        return $this->id;
   	 }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Etape
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Etape
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return Etape
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Set idProjet
     *
     * @param integer $idProjet
     * @return Etape
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    
        return $this;
    }

    /**
     * Set lienImage
     *
     * @param string $lienImage
     * @return Etape
     */
    public function setLienImage($lienImage)
    {
        $this->lienImage = $lienImage;
    
        return $this;
    }

    /**
     * Get lienImage
     *
     * @return string 
     */
    public function getLienImage()
    {
        return $this->lienImage;
    }

    /**
     * Set avancement
     *
     * @param integer $avancement
     * @return Etape
     */
    public function setAvancement($avancement)
    {
        $this->avancement = $avancement;
    
        return $this;
    }

    /**
     * Get avancement
     *
     * @return integer 
     */
    public function getAvancement()
    {
        return $this->avancement;
    }
}