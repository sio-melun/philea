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

class ArticleController extends Controller {    /**
     * @Route("/article/", name="philea_article")
     * @Template()
     */
    public function ArticleAction() {
        $articles = $this->getDoctrine()->getRepository('PhileaBundle:Article')->findAll();
        return $this->render('PhileaBundle:Article:article.html.twig', array('articles' => $articles));
    }
    
    /**
     * @Route("/article/ajoutArticle/", name="philea_article_ajouter")
     * @Template()
     */
    public function ajoutArticleAction() {
            $user = $this->getUser();

            // On crée un objet etape
            $article = new Article();
            $article->setUser($user);
            $article->setEtat(Etape::ATTENTE_VALIDATION);
            // J'ai raccourci cette partie, car c'est plus rapide à écrire !
            $form = $this->createFormBuilder($article)
                    ->add('titre', 'text')
                    ->add('contenu', 'textarea', array(
                        'attr' => array(
                            'class' => 'tinymce',
                            'data-theme' => 'advanced'), 'required' => true))
                    ->add('Envoyer', 'submit')
                    ->getForm();

            // On récupère la requête
            $request = $this->get('request');
            // On vérifie qu'elle est de type POST
            if ($request->getMethod() == 'POST') {
                // On fait le lien Requête <-> Formulaire
                $form->handleRequest($request);

                // On vérifie que les valeurs entrées sont correctes
                // (Nous verrons la validation des objets en détail dans le prochain chapitre)
                if ($form->isValid()) {
                    // On l'enregistre notre objet dans la base de données
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($article);
                    $em->flush();

                    // On redirige vers la page des articles
                    return $this->redirect($this->generateUrl('philea_article'));
                }
            }

            // À ce stade :
            // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
            // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
            // On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
            return $this->render('PhileaBundle:Article:ajoutArticle.html.twig', array(
                        'form' => $form->createView()));
    }
    
    /**
     * @Route("/article/publier/{id}/",name="philea_article_publier")
     * @Template()
     */
    public function publierArticleAction($id) {
            $em = $this->getDoctrine()->getManager();
            $article = $em->getRepository('PhileaBundle:Article')->find($id);
            $article->setEtat(Article::VALIDE);
            $em->flush();

            return $this->redirect($this->generateUrl('philea_article'));
    }
    
        /**
     * @Route("/article/modifier/{id}/",name="philea_article_modifier")
     * @Template()
     */
    public function modifierArticleAction($id) {
        
            $em = $this->getDoctrine()->getManager();

            // On récupère l'entité correspondant à l'id $id
            $article = $em->getRepository('PhileaBundle:Article')
                    ->find($id);

            // Si l'etape n'existe pas, on affiche une erreur 404
            if ($article == null) {
                throw $this->createNotFoundException('article id=' . $id . ' inexistant');
            }
            
            //J'ai choisis de ne pas modifier l'état de l'article
            //$article->setEtat(Article::ATTENTE_VALIDATION);
            
            // J'ai raccourci cette partie, car c'est plus rapide à écrire !
            $form = $this->createFormBuilder($article)
                    ->add('titre', 'text')
                    ->add('contenu', 'textarea', array(
                        'attr' => array(
                            'class' => 'tinymce',
                            'data-theme' => 'advanced'), 'required' => true))
                    ->add('save', 'submit')
                    ->getForm();

            // On récupère la requête
            $request = $this->get('request');

            // On vérifie qu'elle est de type POST
            if ($request->getMethod() == 'POST') {
                // On fait le lien Requête <-> Formulaire
                $form->handleRequest($request);

                // On vérifie que les valeurs entrées sont correctes
                // (Nous verrons la validation des objets en détail dans le prochain chapitre)
                if ($form->isValid()) {
                    // On l'enregistre notre objet $etape dans la base de données
                    $em = $this->getDoctrine()->getManager();

                    $em->persist($article);
                    $em->flush();

                    // On redirige vers la page des articles
                    return $this->redirect($this->generateUrl('philea_article'));
                }
            }

            return $this->render('PhileaBundle:Article:ajoutArticle.html.twig', array(
                        'form' => $form->createView()));
        }
    
    
    /**
     * @Route("/article/invalider/{id}/",name="philea_article_invalider")
     * @Template()
     */
    public function invaliderArticleAction($id) {
       
            $em = $this->getDoctrine()->getManager();
            $article = $em->getRepository('PhileaBundle:Article')->find($id);
            $article->setEtat(Article::ATTENTE_VALIDATION);
            $em->flush();

            return $this->redirect($this->generateUrl('philea_article'));
    }
}