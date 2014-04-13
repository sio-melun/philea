<?php

namespace Cnes\PhileaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cnes\PhileaBundle\Entity\Etape;
use Cnes\PhileaBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class RedactionController extends Controller {/**
     * @Route("/redacteur/",name="philea_redacteurs")
     * @Template()
     */
    public function redacteurAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $projets = $user->getProjets();
        $etapes = $this->getDoctrine()
                ->getRepository('PhileaBundle:Etape')
                ->findByUser($user->getId());

        return $this->render('PhileaBundle:Default:redacteur.html.twig', array('projets' => $projets, 'etapes' => $etapes));
    }
    
        /**
     *  détermine si l'idEtape est une étape d'un des projets de l'utilisateur courant
     *  @param $idEtape l'étape oBjet d'un traitement d'écriture
     *  @return true si etape->project in $user->projects, false sinon
     */
    public function isEtapeInUserProjects($idEtape, $user) {
        //$user = $this->getUser();
        // obtenir les projets de l'utilisateur
        $projets = $user->getProjets();
        
        //Récupère l'idProjet selon l'étape en cours
        $etape = $this->getDoctrine()
                        ->getRepository('PhileaBundle:Etape')
                        ->find($idEtape);
        
        if($etape)
            $projetEtape = $etape->getProjet();
        else
            throw $this->createNotFoundException('Cette étape n\existe pas');
        // l'utilisateur a-t-il le droit sur cette étape ?
        for ($i = 0; $i < count($projets); $i++) {
            if (isset($projets[$i])) {
                if ($projets[$i]->getId() == $projetEtape->getId()) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * @Route("/redacteur/ajoutEtape/{idProjet}/", name="philea_redacteur_etape_ajouter")
     * @Template()
     */
    public function ajoutEtapeAction($idProjet) {
          $user = $this->getUser();

        $projet = $this->getDoctrine()
                        ->getRepository('PhileaBundle:Projet')->find($idProjet);

        $projets = $user->getProjets();

        $ajoutApprouve = false;

        for ($i = 0; $i <= count($projets); $i++) {
            if (isset($projets[$i])) {
                if ($projets[$i]->getId() == $projet->getId()) {
                    $ajoutApprouve = true;
                }
            }
        }
        if ($ajoutApprouve) {



            // On crée un objet etape
            $etape = new Etape();
            $etape->setUser($user);
            $etape->setProjet($projet);
            $etape->setIsValide(Etape::ATTENTE_VALIDATION);
            // J'ai raccourci cette partie, car c'est plus rapide à écrire !
            $form = $this->createFormBuilder($etape)
                    ->add('titre', 'text')
                    ->add('categorie', 'choice', array(
                        'choices' => array('Libre' => 'Libre', 'Analyse/Conception' => 'Analyse/Conception', 'Réalisation' => 'Réalisation'),
                        'required' => true,
                    ))
                    ->add('contenu', 'textarea', array(
                        'attr' => array(
                            'class' => 'tinymce',
                            'data-theme' => 'advanced'), 'required' => true))
                    ->add('file')
                    ->add('avancement', 'text', array('attr' => array('value' => $projet->getAvancementMaxNonPublie() + 1)))
                    ->add('Envoyer', 'submit')
                    ->getForm();

            // On récupère la requête
            $request = $this->get('request');
            // On vérifie qu'elle est de type POST
            if ($request->getMethod() == 'POST') {
                // On fait le lien Requête <-> Formulaire
                // À partir de maintenant, la variable $etape contient les valeurs entrées dans le formulaire par le visiteur
                $form->bind($request);

                // On vérifie que les valeurs entrées sont correctes
                // (Nous verrons la validation des objets en détail dans le prochain chapitre)
                if ($form->isValid()) {
                    // On l'enregistre notre objet $etape dans la base de données
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($etape);
                    $em->flush();


                    // On redirige vers la page de des rédacteurs
                    return $this->redirect($this->generateUrl('philea_redacteurs'));
                }
            }

            // À ce stade :
            // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
            // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
            // On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
            return $this->render('PhileaBundle:Default:formAddEtape.html.twig', array(
                        'form' => $form->createView()));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accéder à cette page');
        }
    }

    /**
     * @Route("/redacteur/modifEtape/{id}/",name="philea_redacteur_etape_modifier")
     * @Template()
     */
    public function modifierAction($id) {
        $user = $this->getUser();
        
        if ($this->isEtapeInUserProjects($id, $user)) {
            // On récupère l'EntityManager
            $em = $this->getDoctrine()->getManager();

            // On récupère l'entité correspondant à l'id $id
            $etape = $em->getRepository('PhileaBundle:Etape')
                    ->find($id);

            // Si l'etape n'existe pas, on affiche une erreur 404
            if ($etape == null) {
                throw $this->createNotFoundException('etape id=' . $id . '] inexistante');
            }
            $etape->setIsValide(Etape::ATTENTE_VALIDATION);
            // J'ai raccourci cette partie, car c'est plus rapide à écrire !
            $form = $this->createFormBuilder($etape)
                    ->add('titre', 'text')
                    ->add('categorie', 'choice', array(
                        'choices' => array('Libre' => 'Libre', 'Analyse/Conception' => 'Analyse/Conception', 'Réalisation' => 'Réalisation'),
                        'required' => true,
                    ))
                    ->add('contenu', 'textarea', array(
                        'attr' => array(
                            'class' => 'tinymce',
                            'data-theme' => 'advanced'), 'required' => true))
                    ->add('file')
                    ->add('avancement')
                    ->add('save', 'submit')
                    ->getForm();

            // On récupère la requête
            $request = $this->get('request');

            // On vérifie qu'elle est de type POST
            if ($request->getMethod() == 'POST') {
                // On fait le lien Requête <-> Formulaire
                // À partir de maintenant, la variable $etape contient les valeurs entrées dans le formulaire par le visiteur
                $form->bind($request);

                // On vérifie que les valeurs entrées sont correctes
                // (Nous verrons la validation des objets en détail dans le prochain chapitre)
                if ($form->isValid()) {
                    // On l'enregistre notre objet $etape dans la base de données
                    $em = $this->getDoctrine()->getManager();

                    $em->persist($etape);
                    $em->flush();


                    // On redirige vers la page de visualisation de l'etape nouvellement créé

                    return $this->redirect($this->generateUrl('philea_redacteurs'));
                }
            }

            return $this->render('PhileaBundle:Default:ajoutEtape.html.twig', array(
                        'form' => $form->createView()));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accéder à cette page');
        }
    }

    /**
     * @Route("/redacteur/delete/etape/{id}/",name="philea_redacteur_etape_supprimer")
     * @Template()
     */
    public function deleteEtapeAction($id) {

       $user = $this->getUser();
        
        if ($this->isEtapeInUserProjects($id, $user)) {
            $em = $this->getDoctrine()->getManager();
            $etape = $em->getRepository('PhileaBundle:Etape')->find($id);
            $etape->setIsValide(Etape::SUPPRIMEE);
            $em->flush();


            return $this->redirect($this->generateUrl('philea_redacteurs'));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accéder à cette page');
        }
    }
    
    
    
}