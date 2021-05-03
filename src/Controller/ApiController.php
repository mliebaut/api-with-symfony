<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/articles", name="articles", methods={"GET"})
     */
    public function getAllArticles(ArticleRepository $articleRepository): Response
    {

        $allArticles = $articleRepository->findAll();
        dump($allArticles);

        foreach ($allArticles as $article) {
            $articles[] = [
                'title'=> $article->getTitle(),
                'description'=> $article->getDescription()
            ];
        }
        return $this->json([
            $articles
        ]);
    }

    /**
     * @Route ("/articles/{id}"), name="article_by_id", methods={"GET"}, requirements={"id"}={"\d+"})
     */

    public function getArticlebyId(int $id, ArticleRepository $articleRepository):Response {
        $article = $articleRepository->findOneBy(['id' => $id]);

        dump($article);

        return $this->json([
            'article' => $article
        ]);
    }
}

