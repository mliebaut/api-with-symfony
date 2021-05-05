<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Entity\EtatDesLieux;
use App\Repository\EtatDesLieuxRepository;

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
        // dump($allArticles);

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
        $jsonRecu = json_decode($request->getContent());

        // dd($jsonRecu);
        if ($jsonRecu->apikey == 'keytest') {
        
            $newpost = $serializer->deserialize($request->getContent(), Article::class, 'json');

            $em->persist($newpost);
            $em->flush();

            return new Response('ok');
        }
        else {
            return new Response('erreur');
        }
    }

    // /**
    //  * @Route("/articles/{id}", name="delete_article_by_id", methods={"DELETE"}, requirements={"id"}={"\d+"})
    //  */
    // public function deleteArticleById($id): JsonResponse
    // {
    //     $article = $articleRepository->findOneBy(['id' => $id]);

    //     $this->$articleRepository->removeArticle($article);

    //     return new JsonResponse(['status' => 'Article deleted'], Response::HTTP_NO_CONTENT);
    // }

    /**
     * @Route("/etatsdeslieux", name="etats_des_lieux", methods={"GET"})
     */
    public function getAllEtatsDesLieux(EtatDesLieuxRepository $etatdeslieuxRepository): Response
    {

        $alletatsdeslieux = $etatdeslieuxRepository->findAll();
        dump($alletatsdeslieux);

        foreach ($alletatsdeslieux as $etatdeslieux) {
            $alletatsdeslieux[] = [
                'titre'=> $etatdeslieux->getTitre(),
                'nombre de pieces'=> $etatdeslieux->getNbPieces(),
                'surface' => $etatdeslieux->getSurface(),
                'photo' =>$etatdeslieux->getPhoto(),
                'types' => $etatdeslieux->getTypes()
            ];
        }
        return $this->json([
            $alletatsdeslieux
        ]);
    }
}

