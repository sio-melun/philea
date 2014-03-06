<?php

namespace Cnes\PhileaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cnes\PhileaBundle\Entity\Etape;
use Cnes\PhileaBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/",name="philea_index")
     * @Template()
     */
    public function indexAction() {
        return $this->render('PhileaBundle:Default:accueil.html.twig');
    }


    /**
     * @Route("/synoptique", name="philea_synoptique")
     * @Template()
     */
    public function synoptiqueAction() {
        return $this->render('PhileaBundle:Default:index.html.twig');
    }

    /**
     * @Route("/domaine/{idDomaine}/",name="philea_domaine")
     * @Template()
     */
    public function domaineAction($idDomaine) {
        $domaine = $this->getDoctrine()->getRepository('PhileaBundle:Domaine')
                ->find($idDomaine);

        if (!$domaine) {
            throw $this->createNotFoundException('Aucun domaine trouvé');
        }

        $projets = $this->getDoctrine()->getRepository('PhileaBundle:Domaine')->find($idDomaine)->getProjets();

        return array('domaine' => $domaine, 'projets' => $projets/* , 'etapes' => $etapes */);
    }

    /**
     * @Route("/projet/{idProjet}/", name="philea_projet"))
     * @Template()
     */
    public function projetAction($idProjet) {
        /* $projet = $this->getDoctrine()->getRepository('PhileaBundle:Projet')
          ->find($idProjet); */

        $domaine = $this->getDoctrine()->getRepository('PhileaBundle:Projet')
                        ->find($idProjet)->getDomaine();
        $etapes = $this->getDoctrine()->getRepository('PhileaBundle:Etape')
                ->findBy(
                array('projet' => $idProjet, 'isValide' => 1), array('avancement' => 'DESC'));

        if (!$etapes) {
            throw $this->createNotFoundException('Aucune étape de projet trouvée pour ce projet');
        }

        return array('domaine' => $domaine, 'etapes' => $etapes);
    }

    /**
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
            $user = $this->getUser();

            // On crée un objet Article
            $article = new Etape();
            $article->setUser($user);
            $article->setProjet($projet);
            $article->setIsValide(Etape::ATTENTE_VALIDATION);
            // J'ai raccourci cette partie, car c'est plus rapide à écrire !
            $form = $this->createFormBuilder($article)
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
                    ->add('Envoyer', 'submit')
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
                    return $this->redirect($this->generateUrl('cnes_philea_default_redacteur'));
                }
            }

            // À ce stade :
            // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
            // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
            // On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
            return $this->render('PhileaBundle:Default:formAddEtape.html.twig', array(
                        'form' => $form->createView()));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accédez à cette page');
        }
    }

    /**
     * @Route("/redacteur/modifEtape/{id}/",name="philea_redacteur_etape_modifier")
     * @Template()
     */
    public function modifierAction($id) {
        $user = $this->getUser();

        $projets = $user->getProjets();

        //Récupère l'idProjet selon l'étape en cours
        $projetEtape = $this->getDoctrine()
                        ->getRepository('PhileaBundle:Etape')
                        ->find($id)->getProjet();

        $modificationApprouve = false;

        for ($i = 0; $i <= count($projets); $i++) {
            if (isset($projets[$i])) {
                if ($projets[$i]->getId() == $projetEtape->getId()) {
                    $modificationApprouve = true;
                }
            }
        }

        if ($modificationApprouve) {
            // On récupère l'EntityManager
            $em = $this->getDoctrine()->getManager();

            // On récupère l'entité correspondant à l'id $id
            $article = $em->getRepository('PhileaBundle:Etape')
                    ->find($id);

            // Si l'article n'existe pas, on affiche une erreur 404
            if ($article == null) {
                throw $this->createNotFoundException('Article[id=' . $id . '] inexistant');
            }
            $article->setIsValide(Etape::ATTENTE_VALIDATION);
            // J'ai raccourci cette partie, car c'est plus rapide à écrire !
            $form = $this->createFormBuilder($article)
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

                    return $this->redirect($this->generateUrl('cnes_philea_default_redacteur'));
                }
            }

            return $this->render('PhileaBundle:Default:ajoutEtape.html.twig', array(
                        'form' => $form->createView()));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accédez à cet page');
        }
    }

    /**
     * @Route("/redacteur/delete/etape/{id}/",name="philea_redacteur_etape_supprimer")
     * @Template()
     */
    public function deleteEtapeAction($id) {

        $user = $this->getUser();


        $projets = $user->getProjets();

        //Récupère l'idProjet selon l'étape en cours
        $projetEtape = $this->getDoctrine()
                        ->getRepository('PhileaBundle:Etape')
                        ->find($id)->getProjet();

        $deleteApprouve = false;

        for ($i = 0; $i <= count($projets); $i++) {
            if (isset($projets[$i])) {
                if ($projets[$i]->getId() == $projetEtape->getId()) {
                    $deleteApprouve = true;
                }
            }
        }

        if ($deleteApprouve) {
            $em = $this->getDoctrine()->getManager();
            $etape = $em->getRepository('PhileaBundle:Etape')->find($id);
            $etape->setIsValide(Etape::SUPPRIMEE);
            $em->flush();


            return $this->redirect($this->generateUrl('cnes_philea_default_redacteur'));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accédez à cet page');
        }
    }

    /**
     * @Route("/gestion/",name="philea_gestionnaires")
     * @Template()
     */
    public function gestionAction() {
        //Vérification dans la vue

        $user = $this->getUser();

        $userProjets = $user->getProjets();

        $lesEtapes = $this->getDoctrine()->getRepository('PhileaBundle:Etape')->findAll();

        return $this->render('PhileaBundle:Default:gestion.html.twig', array('lesEtapes' => $lesEtapes, 'userProjets' => $userProjets));
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

            $etape->setIsValide(Etape::VALIDE);

            $em->flush();

            // if ($this->get('security.context')->isGranted('ROLE_GESTIONNAIRE'))

            return $this->redirect($this->generateUrl('cnes_philea_default_gestion'));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accédez à cet page');
        }
    }

    /**
     * @Route("/gestion/modifEtape/{id}/",name="philea_gestionnaire_etape_modifier")
     * @Template()
     */
    public function modifierGestionAction($id) {

        $user = $this->getUser();

        $projets = $user->getProjets();

        //Récupère l'idProjet selon l'étape en cours
        $projetEtape = $this->getDoctrine()
                        ->getRepository('PhileaBundle:Etape')
                        ->find($id)->getProjet();

        $modificationApprouve = false;

        for ($i = 0; $i <= count($projets); $i++) {
            if (isset($projets[$i])) {
                if ($projets[$i]->getId() == $projetEtape->getId()) {
                    $modificationApprouve = true;
                }
            }
        }

        if ($modificationApprouve) {
            // On récupère l'EntityManager
            $em = $this->getDoctrine()->getManager();

            // On récupère l'entité correspondant à l'id $id
            $article = $em->getRepository('PhileaBundle:Etape')
                    ->find($id);

            // Si l'article n'existe pas, on affiche une erreur 404
            if ($article == null) {
                throw $this->createNotFoundException('Article[id=' . $id . '] inexistant');
            }

            // J'ai raccourci cette partie, car c'est plus rapide à écrire !
            $form = $this->createFormBuilder($article)
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
                    return $this->redirect($this->generateUrl('cnes_philea_default_gestion'));
                }
            }

            return $this->render('PhileaBundle:Default:ajoutEtape.html.twig', array(
                        'form' => $form->createView()));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accédez à cet page');
        }
    }

    /**
     * @Route("/gestion/delete/etape/{id}/",name="philea_gestionnaire_etape_supprimer")
     * @Template()
     */
    public function deleteGestionAction($id) {

        $user = $this->getUser();

        $projets = $user->getProjets();

        //Récupère l'idProjet selon l'étape en cours
        $projetEtape = $this->getDoctrine()
                        ->getRepository('PhileaBundle:Etape')
                        ->find($id)->getProjet();

        $deleteApprouve = false;

        for ($i = 0; $i <= count($projets); $i++) {
            if (isset($projets[$i])) {
                if ($projets[$i]->getId() == $projetEtape->getId()) {
                    $deleteApprouve = true;
                }
            }
        }

        if ($deleteApprouve) {
            $em = $this->getDoctrine()->getManager();
            $etape = $em->getRepository('PhileaBundle:Etape')->find($id);
            // si l'étape est actuellement publiée, elle sera d'abord mise en attente
            // sinon (ATTENTE_VALIDATION) elle sera marquée SUPPRIMEE
            if ($etape->getIsValide() == Etape::VALIDE)
                $etape->setIsValide(Etape::ATTENTE_VALIDATION);
            else
                $etape->setIsValide(Etape::SUPPRIMEE);
            $em->flush();

            return $this->redirect($this->generateUrl('cnes_philea_default_gestion'));
        } else {
            throw $this->createNotFoundException('Vous n\'avez pas le droit d\'accédez à cet page');
        }
    }

    /**
     * @Route("/utilisateurs/",name="philea_utilisateurs")
     * @Template()
     */
    public function usersAction() {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('PhileaBundle:Default:users.html.twig', array('users' => $users));
    }

    /**
     * @Route("/utilisateurs/projets/{idUser}",name="philea_utilisateur_projets")
     * @Template()
     */
    public  function userProjetsAction($idUser) {

        $projets = $this->getDoctrine()
                        ->getRepository('PhileaBundle:User')
                        ->find($idUser)->getProjets();

        $user = $this->getDoctrine()
                ->getRepository('PhileaBundle:User')
                ->find($idUser);

        return $this->render('PhileaBundle:Default:projetsuser.html.twig', array('projets' => $projets, 'user' => $user));
    }

    /**
     * @Route("/utilisateurs/projetsuser/delete/{idUser}/{idProjet}",name="philea_utilisateur_projet_retirer")
     * @Template()
     */
    public function userProjetsDeleteAction($idUser, $idProjet) {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository('PhileaBundle:User')->find($idUser);
        $projet = $this->getDoctrine()->getRepository('PhileaBundle:Projet')->find($idProjet);
        $user->removeProjet($projet);
        $em->flush();

        return $this->redirect($this->generateUrl('philea_utilisateur_projets', array('idUser' => $idUser)));
    }

    /**
     * @Route("/utilisateurs/projet/ajout/{idUser}/",name="philea_utilisateur_projet_ajouter")
     * @Template()
     */
    public function userProjetsAjoutAction(Request $request, $idUser) {
        // En cours !!!!
        // TODO présenter les projets non encore associés à l'utilisateur d'id = idUser

        $projets = $this->getDoctrine()
            ->getRepository('PhileaBundle:Projet')->findAll();

        $userRedacteur = $this->getDoctrine()
                        ->getRepository('PhileaBundle:User')->find($idUser);

        //$projetsGestionnaire = $this->getDoctrine()
        //                ->getRepository('PhileaBundle:User')->find($this->getUser())->getProjets();

        $form = $this->createFormBuilder()
                ->add('projet_id', 'choice', array(
                        'choices' => array('1' => '1', '2' => '2', '3' => '3'
                                            , '4' => '4', '5' => '5', '6' => '6'
                                            , '7' => '7', '8' => '8', '9' => '9'
                                            , '10' => '10', '11' => '11', '12' => '12'
                                            , '13' => '13', '14' => '14', '15' => '15'
                                            , '16' => '16', '17' => '17', '18' => '18'
                                            , '19' => '19', '20' => '20', '21' => '21'
                                            , '22' => '22', '23' => '23', '24' => '24'
                                            , '25' => '25', '26' => '26', '27' => '27'
                                            , '28' => '28', '29' => '29', '30' => '30'
                        ,'required' => true,
                    )))
                ->add('Ajouter', 'submit')
                ->getForm();

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                $data = $request->request->all();
                $user_id = $idUser;
                $projet_id = $data['form']['projet_id'];

                $em = $this->getDoctrine()->getManager();
                $user = $this->getDoctrine()->getRepository('PhileaBundle:User')->find($user_id);
                $projet = $this->getDoctrine()->getRepository('PhileaBundle:Projet')->find($projet_id);

                $user->addProjet($projet);
                $em->flush();

                return $this->redirect($this->generateUrl('philea_utilisateur_projets', array('idUser' => $idUser)));
            }
        }

        return $this->render('PhileaBundle:Default:formAddUserProjet.html.twig', array(
                    'form' => $form->createView(), 'idUser' => $idUser, 'projetsGestionnaire' =>$projets
        ));
    }


    /**
     * @Route("/projets", name="philea_projets")
     * @Template()
     */
    public function projetsListAction() {
        $em = $this->getDoctrine()->getManager();
        $projets = $this->getDoctrine()->getRepository('PhileaBundle:Projet')->findAll();//getMyAll();//findAll();
        $user = $this->getUser();

        /*$logger = $this->get('logger');
        $logger->info("L'utilisateur a pour roles : " . $user->getRoles());//null ou tableau !*/

        $repo =  $this->getDoctrine()->getRepository('PhileaBundle:Projet');

        $gest = array();
        foreach ($projets as $p) :
          $gestionnaires =  $repo->getAllGestionnaires($p->getId());
          if (!$gestionnaires)
              $gestionnaires = "(vide)";
          else {
            $res="";
            foreach ($gestionnaires as $u) :
                if ($res) $res =", ";
                $res .= $u->getUsername();
            endforeach;
            $gestionnaires = $res;
          }
          $gest[$p->getId()] = $gestionnaires;
        endforeach;
        return array('projets'=> $projets, 'user'=> $user, 'gest'=>$gest);
    }

}
