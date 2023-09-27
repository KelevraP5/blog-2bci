<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_article')]
    public function allArticles(EntityManagerInterface $em, Request $request): Response
    {

        $articlesRepo = $em->getRepository(Articles::class);
        $findArticles = $articlesRepo->findAll();


        return $this->render('article/index.html.twig', [
            'allArticles' => $findArticles,
        ]);
    }

    #[Route('/article/{id}', name: 'app_single_article')]
    public function singleArticle(Articles $articles): Response
    {

        return $this->render('article/single.html.twig', [
            'article' => $articles,
        ]);
    }
}
