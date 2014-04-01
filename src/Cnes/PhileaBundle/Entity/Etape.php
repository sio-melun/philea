<?php

namespace Cnes\PhileaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Etape
 *
 * @ORM\Table(name="Etape")
 * @ORM\Entity(repositoryClass="Cnes\PhileaBundle\Entity\EtapeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Etape
{
    const SUPPRIMEE = -1;
    const ATTENTE_VALIDATION = 0;
    const VALIDE = 1;

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
     * @ORM\Column(name="titre", type="string", length=70)
     */
    private $titre;
    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=70)
     */
    private $categorie;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champ doit-être complété")
     * @ORM\Column(name="contenu", type="string", length=2048, nullable=true)
     */
    private $contenu;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateEntre", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;


    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=true, name="idUser", referencedColumnName="id")
     */
    protected $user;


    /**
     * @ORM\ManyToOne(targetEntity="Projet")
     * @ORM\JoinColumn(nullable=true, name="idProjet", referencedColumnName="id")
     */
    protected $projet;

    /**
     * @var int
     *
     * @ORM\Column(name="isValide", nullable=true)
     */
    protected $isValide;

    /**
     * @var integer
     *
     * @ORM\Column(name="Avancement", type="decimal", scale=2)
     */
    private $avancement;

    /**
     * @Assert\File(maxSize="5M")
     */
    public $file;

    public function __construct()
    {
        $this->date = new \Datetime;
        $this->path = 'no-picture.jpg';
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

    /**
     * Set isValide
     *
     * @param string $isValide
     * @return Etape
     */
    public function setIsValide($isValide)
    {
        $this->isValide = $isValide;

        return $this;
    }

    /**
     * Get isValide
     *
     * @return string
     */
    public function getIsValide()
    {
        return $this->isValide;
    }


    //Upload d'image à partir d'ici
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'img/upload';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->path);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }



    /**
     * Set path
     *
     * @param string $path
     * @return Etape
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

    public function __toString()
    {
        return strval($this->id);
    }

    /**
     * Set user
     *
     * @param \Cnes\PhileaBundle\Entity\User $user
     * @return Etape
     */
    public function setUser(\Cnes\PhileaBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Cnes\PhileaBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set projet
     *
     * @param \Cnes\PhileaBundle\Entity\Projet $projet
     * @return Etape
     */
    public function setProjet(\Cnes\PhileaBundle\Entity\Projet $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \Cnes\PhileaBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Etape
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}