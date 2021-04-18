<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\AjoutArticleFormType;
use App\Entity\Commentaires;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentaireFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Articles::class)->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/article/nouveau", name="ajout_article")
     */
    public function ajoutArticle(Request $request){
        $article = new Articles();
        
        $form = $this->createForm(AjoutArticleFormType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $article->setUsers($this->getUser());
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($article);
            $doctrine->flush();

            $this->addFlash('message', 'Votre article à bien été publié sur le site');

            return $this->redirectToRoute('accueil');
        }
        return $this->render('articles/ajout.html.twig',[
            'articleForm' => $form->createView()
        ]);
     }

    /**
     * @Route("/article/{label}", name="article")
     */
    public function article($label, Request $request){
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy([
            'label' => $label
        ]);

        if(!$article){
            throw $this->createNotFoundException("l'article recherché n'existe pas"); 
        }

        // initialisation entité commentaires 
        $commentaire = new Commentaires();
        
        // Creation de l'objet formulaire 
        $form = $this->createForm(CommentaireFormType::class, $commentaire);

        //recuperation des données saisies dans le formulaire 
        $form->handleRequest($request);
        
        // on verifie si le formulaire a été envoyé et si les données sont valides 
        if($form->isSubmitted() && $form->isValid()){
            $commentaire->setArticles($article);
            $commentaire->setCreatedAt(new \DateTime('now'));

            //on instancie Doctrine 
            $doctrine = $this->getDoctrine()->getManager();

            $doctrine->persist($commentaire);

            $doctrine->flush();

        }
        return $this->render('articles/article.html.twig', [
            'article' => $article, 
            'commentForm' => $form->createView()             
            ]); 
    }
}
