<?php

namespace Cnes\PhilaeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cnes\PhilaeBundle\Entity\Etape;
use Cnes\PhilaeBundle\Entity\UserProjet;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('PhilaeBundle:Default:accueil.html.twig');
    }
    /**
     * @Route("/structure/")
     * @Template()
     */
    public function structureAction()
    {
        return $this->render('PhilaeBundle:Default:structure.html.twig');
    }



    /**
     * @Route("/comete/")
     * @Template()
     */
    public function cometeAction()
    {
        return $this->render('PhilaeBundle:Default:comete.html.twig');
    }

    /**
     * @Route("/projet_cnes/")
     * @Template()
     */
    public function projet_cnesAction()
    {
        return $this->render('PhilaeBundle:Default:projet_cnes.html.twig');
    }

    /**
     * @Route("/site_web/")
     * @Template()
     */
    public function site_webAction()
    {
        return $this->render('PhilaeBundle:Default:site_web.html.twig');
    }

    /**
     * @Route("/admin/")
     * @Template()
     */
    public function adminAction()
    {
        $user = $this->container -> get('security.context')->getToken()->getUser()->getId();
        $projets = $this->getDoctrine()
            ->getRepository('PhilaeBundle:User')
            ->find($user);

        return $this->render('PhilaeBundle:Default:admin.html.twig', array('projets' => $projets->getProjets()));
    }


    /**
     * @Route("/admin/ajoutEtape/{idProjet}/")
     * @Template()
     */
    public function ajoutEtapeAction($idProjet)
    {
        $user = $this->container -> get('security.context')->getToken()->getUser()->getId();

        // On crée un objet Article
        $article = new Etape();
        $article->setIdUser($user);
        $article->setIdProjet($idProjet);
        // J'ai raccourci cette partie, car c'est plus rapide à écrire !
        $form = $this->createFormBuilder($article)

            ->add('titre', 'text')
            ->add('contenu', 'text')
            ->add('date', 'date')
            ->add('lienImage', 'text')
            ->add('avancement', 'integer')
            ->add('save', 'submit')
            ->getForm();

        // On récupère la requête
        $request = $this->get('request');

        // On vérifie qu'elle est de type POST
        if ($request->getMethod() == 'POST') {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire par le visiteur
            $form->bind($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On l'enregistre notre objet $article dans la base de données
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                // On redirige vers la page de visualisation de l'article nouvellement créé
                return $this->redirect($this->generateUrl('cnes_philae_default_admin'));
            }
        }

        // À ce stade :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau


        // On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('PhilaeBundle:Default:ajoutEtape.html.twig', array(
            'form' => $form->createView()));

    }

    /**
     * @Route("/projets/{page}/")
     * @Template()
     */
    public function pageAction($page) {
        $lesProjets = $this -> getDoctrine() -> getRepository('PhilaeBundle:Projet') -> findBy(
            array('id' => $page));
        $lesEtapes = $this -> getDoctrine() -> getRepository('PhilaeBundle:Etape') -> findBy(
            array('idProjet' => $page),
            array('avancement' => 'DESC'));
        $lesAvancements = $this -> getDoctrine() -> getRepository('PhilaeBundle:Avancement') -> findBy(
            array('idProjet' => $page));
        return array('lesProjets' => $lesProjets,'lesEtapes' => $lesEtapes, 'lesAvancements' => $lesAvancements);
    }

}