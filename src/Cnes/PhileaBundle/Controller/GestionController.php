<?php

namespace Cnes\PhileaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cnes\PhileaBundle\Entity\Etape;
use Cnes\PhileaBundle\Entity\Article;
use Cnes\PhileaBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class GestionController extends Controller {

/**
     * @Route("/gestion/",name="philea_gestionnaires")
     * @Template()
     */
    public function gestionAction() {
        //Vérification dans la vue

        $user = $this->getUser();

        $userProjets = $user->getProjets();

        $lesEtapes = $this->getDoctrine()->getRepository('PhileaBundle:Etape')->findAll();

        return $this->render('PhileaBundle:Gestion:gestion.html.twig', array('lesEtapes' => $lesEtapes, 'userProjets' => $userProjets));
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
     * @Route("/gestion/publierEtape/{id}",name="philea_gestionnaire_etape_publier")
     * @Template()
     */
    public function publierGestionAction($id) {

        $user = $this->getUser();

        $projets = $user->getProjets();

        //Récupère l'idProjet selon l'étape en cours
        $projetEtape = $this->getDoctrine()
                        ->getRepository('PhileaBundle:Etape')
                        ->find($id)->getProjet();


        $publierApprouve = false;

        for ($i = 0; $i <= count($projets); $i++) {
            if (isset($projets[$i])) {
                if ($projets[$i]->getId() == $projetEtape->getId()) {
                    $publierApprouve = true;
                }
            }
        }

        if ($publierApprouve) {
            $em = $this->getDoctrine()->getManager();
            $etape = $em->getRepository('PhileaBundle:Etape')->find($id);

            $etape->setEtat(Etape::VALIDE);

            $em->flush();

            // if ($this->get('security.context')->isGranted('ROLE_GESTIONNAIRE'))

            return $this->redirect($this->generateUrl('philea_gestionnaires'));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accéder à cette page');
        }
    }

    /**
     * @Route("/gestion/modifEtape/{id}/",name="philea_gestionnaire_etape_modifier")
     * @Template()
     */
    public function modifierGestionAction($id) {

        $user = $this->getUser();
        
        if ($this->isEtapeInUserProjects($id, $user)) {
            // On récupère l'EntityManager
            $em = $this->getDoctrine()->getManager();

            // On récupère l'entité correspondant à l'id $id
            $etape = $em->getRepository('PhileaBundle:Etape')
                    ->find($id);

            // Si l'etape n'existe pas, on retourne une erreur 404
            if ($etape == null) {
                throw $this->createNotFoundException('etape[id=' . $id . '] inexistant');
            }

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
                            'data-theme' => 'bbcode' // Skip it if you want to use default theme
                        )
                    ))
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

                // $form->bind($request); déprécié, voir  http://symfony.com/doc/current/cookbook/form/direct_submit.html
                $form->handleRequest($request);

                // On vérifie que les valeurs entrées sont correctes
                // (Nous verrons la validation des objets en détail dans le prochain chapitre)
                if ($form->isValid()) {
                    // On l'enregistre notre objet $etape dans la base de données
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($etape);
                    $em->flush();

                    // On redirige vers la page de visualisation de l'etape nouvellement créé
                    return $this->redirect($this->generateUrl('philea_gestionnaires'));
                }
            }

            return $this->render('PhileaBundle:Default:ajoutEtape.html.twig', array(
                        'form' => $form->createView()));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accéder à cette page');
        }
    }

    /**
     * @Route("/gestion/delete/etape/{id}/",name="philea_gestionnaire_etape_invalider")
     * @Template()
     */
    public function invaliderGestionAction($id) {

        $user = $this->getUser();
        
        if ($this->isEtapeInUserProjects($id, $user)) {
            $em = $this->getDoctrine()->getManager();
            $etape = $em->getRepository('PhileaBundle:Etape')->find($id);
            // si l'étape est actuellement publiée, elle sera invalidée

            if ($etape->getEtat() == Etape::VALIDE) {
                $etape->setEtat(Etape::ATTENTE_VALIDATION);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('philea_gestionnaires'));
        } else {
            throw $this->createNotFoundException('Opération non autorisée');
        }
    }
    
}