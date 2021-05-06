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
    public function getAllEtatsDesLieux():Response
    {
        $etatdeslieux = $this->getDoctrine()->getRepository(EtatDesLieux::class)->findAll();

        $listeetatdeslieux = [];

        foreach ($etatdeslieux as $etatlieu) {
            $listeetatdeslieux[] = [
                'id' => $etatlieu->getId(),
                'titre' => $etatlieu->getTitre(),
                'nombre de pieces'=> $etatlieu->getNbPieces(),
                'surface' => $etatlieu->getSurface(),
                'photo' =>$etatlieu->getPhoto(),
                'types' => $etatlieu->getTypes()->getLibelle(),
                'villes' => $etatlieu->getVilles()->getNomVille()
            ];
        }
        dump($listeetatdeslieux);
        return $this->json([
            $listeetatdeslieux
        ]);

        
    }

    /**
    * @Route ("/etatsdeslieux/{id}"), name="etatdeslieux_by_id", methods={"GET"}, requirements={"id"}={"\d+"})
    */

    public function getEtatDesLieuxbyId(int $id, EtatDesLieuxRepository $etatdeslieuxRepository):Response {
        $etatdeslieux = $etatdeslieuxRepository->findOneBy(['id' => $id]);

        $etatdeslieuxdetails[] = [
            'id' => $etatdeslieux->getId(),
            'titre' => $etatdeslieux->getTitre(),
            'nombre de pieces'=> $etatdeslieux->getNbPieces(),
            'surface' => $etatdeslieux->getSurface(),
            'photo' =>$etatdeslieux->getPhoto(),
            'type' => $etatdeslieux->getTypes()->getLibelle(),
            'ville' => $etatdeslieux->getVilles()->getNomVille()
        ];
        dump($etatdeslieuxdetails);
        return $this->json([
            $etatdeslieuxdetails
        ]);

    }

    /**
     * @Route ("/addnew2"), name="add_new_etat_des_lieux", methods={"POST"}
     */

    public function addNewEtatDesLieux(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $jsonRecu = json_decode($request->getContent());

        // dd($jsonRecu);
        if ($jsonRecu->apikey == 'keytest') {

            $type = $em->getRepository('App:Types')->findOneById($jsonRecu->type);
            $ville = $em->getRepository('App:Villes')->findOneById($jsonRecu->ville);

            $new = new EtatDesLieux();
            $new->setTitre($jsonRecu->titre);
            $new->setNbPieces($jsonRecu->nombrepieces);
            $new->setSurface($jsonRecu->surface);
            $new->setPhoto($jsonRecu->photo);
            $new->setTypes($type);
            $new->setVilles($ville);

            $em->persist($new);
            $em->flush();


            return new Response('ok');
        }

        else {
            return new Response('erreur');
        }
    }
}

