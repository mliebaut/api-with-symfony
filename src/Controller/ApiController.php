<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

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

        $articledetails[] = [
            'title' => $article->getTitle(),
            'description' => $article->getDescription()
        ];

        dump($article);
        return $this->json([
            $articledetails
        ]);

    }

    /**
     * @Route ("/addnew"), name="add_new_article", methods={"POST"}
     */

    public function addNewArticle(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $jsonRecu = $request->getContent();

        $newpost = $serializer->deserialize($jsonRecu, Article::class, 'json');

        $em->persist($newpost);
        $em->flush();

        dump($newpost); 

        return $this->json([
            $newpost
        ]);
    }
}

