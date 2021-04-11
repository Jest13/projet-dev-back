<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/article/{label}", name="article")
     */
    public function article($label){
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy([
            'label' => $label
        ]);

        if(!$article){
            throw $this->createNotFoundException("l'article recherché n'existe pas"); 
        }
        
        return $this->render('articles/article.html.twig', compact('article'));

    }
}
