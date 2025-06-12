<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticlController extends AbstractController
{
    #[Route('/article/{id}', name: 'article_show')]
    public function show(Article $article): Response
    {
        return $this->render('articl/show.html.twig', [
            'article' => $article,
        ]);
    }

    // #[Route('/articles', name: 'articles_list')]
    // public function listArticles(ArticleRepository $articleRepository): Response
    // {
    //     $articles = $articleRepository->findAll();

    //     return $this->render('articl/list.html.twig', [
    //         'articles' => $articles,
    //     ]);
    // }


    #[Route('/articles/{type}', name: 'articles_list', defaults: ['type' => 'all'])]
    public function listArticle(ArticleRepository $articleRepository, string $type): Response
    {
        if ($type === 'all') {
            $articles = $articleRepository->findAll();
        } else {
            $articles = $articleRepository->findBy(['type' => $type]);
        }

        return $this->render('articl/list2.html.twig', [
            'articles' => $articles,
            'activeType' => $type,
        ]);
    }

    #[Route('/test1', name: 'app_test1')]
    public function test(): Response
    {
        return $this->render('articl/test.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    // #[Route('/articles3', name: 'app_articles3')]
    // public function index(ArticleRepository $articleRepository): Response
    // {
    //     $articles = $articleRepository->findAll();

    //     // Séparer les articles par type
    //     $articlesType1 = array_filter($articles, fn($article) => $article->getType() === 'National');
    //     $articlesType2 = array_filter($articles, fn($article) => $article->getType() === 'International');

    //     return $this->render('articl/list4.html.twig', [
    //         'articles' => $articles,
    //         'articlesType1' => $articlesType1,
    //         'articlesType2' => $articlesType2,
    //     ]);
    // }


    // #[Route('/articles3', name: 'app_articles3')]
    // public function index(ArticleRepository $articleRepository, Request $request): Response
    // {
    //     $searchTerm = $request->query->get('search', '');
        
    //     // Récupération des articles avec filtrage par recherche si nécessaire
    //     if ($searchTerm) {
    //         $articles = $articleRepository->findBySearchTerm($searchTerm);
    //         $articlesType1 = array_filter($articles, fn($article) => $article->getType() === 'National');
    //         $articlesType2 = array_filter($articles, fn($article) => $article->getType() === 'International');
    //     } else {
    //         $articles = $articleRepository->findAll();
    //         $articlesType1 = array_filter($articles, fn($article) => $article->getType() === 'National');
    //         $articlesType2 = array_filter($articles, fn($article) => $article->getType() === 'International');
    //     }

    //     return $this->render('articl/list4.html.twig', [
    //         'articles' => $articles,
    //         'articlesType1' => $articlesType1,
    //         'articlesType2' => $articlesType2,
    //         'searchTerm' => $searchTerm,
    //     ]);
    // }

    #[Route('/articles3', name: 'app_articles3')]
    public function index(ArticleRepository $articleRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('search', '');
        
        // Création du QueryBuilder
        $queryBuilder = $searchTerm 
            ? $articleRepository->createQueryBuilderForSearch($searchTerm)
            : $articleRepository->createQueryBuilder('a');
        
        // Pagination des résultats
        $articles = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            5, // limite de la page à 5
            [
                'pageParameterName' => 'page',
                'query' => ['search' => $searchTerm] // Conserve le paramètre de recherche
            ]
        );

        return $this->render('articl/list4.html.twig', [
            'articles' => $articles,
            'searchTerm' => $searchTerm,
        ]);
    }

}
