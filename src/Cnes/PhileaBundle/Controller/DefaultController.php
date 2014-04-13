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
        
         $articles = $this->getDoctrine()->getRepository('PhileaBundle:Article')
                ->findBy(
                array('isValide' => 1), array('date' => 'DESC'));

        if (!$articles) {
            throw $this->createNotFoundException('Aucune étape de projet trouvée pour ce projet');
        }
        
        
        return $this->render('PhileaBundle:Default:accueil.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/synoptique", name="philea_synoptique")
     * @Template()
     */
    public function synoptiqueAction() {
        return $this->render('PhileaBundle:Default:synoptique.html.twig');
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

        return $this->render('PhileaBundle:Default:etape.html.twig', array('domaine' => $domaine, 'etapes' => $etapes));
    }

    

     /**
     * @Route("/gestion/utilisateurs/",name="philea_utilisateurs")
     * @Template()
     */
    public function usersAction() {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('PhileaBundle:Default:users.html.twig', array('users' => $users));
    }

    /**
     * @Route("/gestion/utilisateurs/projets/{idUser}",name="philea_utilisateur_projets")
     * @Template()
     */
    public function userProjetsAction($idUser) {

        $projets = $this->getDoctrine()
                        ->getRepository('PhileaBundle:User')
                        ->find($idUser)->getProjets();

        $user = $this->getDoctrine()
                ->getRepository('PhileaBundle:User')
                ->find($idUser);

        return $this->render('PhileaBundle:Default:projetsuser.html.twig', array('projets' => $projets, 'user' => $user));
    }

    /**
     * @Route("/gestion/utilisateurs/projetsuser/delete/{idUser}/{idProjet}",name="philea_utilisateur_projet_retirer")
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
     * @Route("/gestion/utilisateurs/projet/ajout/{idUser}/",name="philea_utilisateur_projet_ajouter")
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
                        , 'required' => true,
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
                    'form' => $form->createView(), 'idUser' => $idUser, 'projetsGestionnaire' => $projets
        ));
    }

    /**
     * @Route("/projets/", name="philea_projets")
     * @Template()
     */
    public function projetsListAction() {
        $em = $this->getDoctrine()->getManager();
        //Passage de 112 à 67 requêtes,
        $projets = $this->getDoctrine()->getRepository('PhileaBundle:Projet')->getAllProjets(); //getMyAll();//findAll();
        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository('PhileaBundle:Projet');

        $gest = array();
        foreach ($projets as $p) :
            $gestionnaires = $repo->getAllGestionnaires($p->getId());
            if (!$gestionnaires)
                $gestionnaires = "(vide)";
            else {
                $res = "";
                foreach ($gestionnaires as $u) :
                    if ($res)
                        $res .=", ";
                    $res .= $u->getUsername();
                endforeach;
                $gestionnaires = $res;
            }
            $gest[$p->getId()] = $gestionnaires;
        endforeach;
        return array('projets' => $projets, 'user' => $user, 'gest' => $gest);
    }

}
