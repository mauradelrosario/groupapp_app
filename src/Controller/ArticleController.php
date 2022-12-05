<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/create', name: 'create_article')]
    public function createArticle(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $product = new Article();
        $product->setName('Art 1');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->render('article/index.html.twig', [
            'product_id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription()
        ]);
    }

    #[Route('/update/{id}', name: 'update_article')]
    public function updateArticle(Article $article): Response
    {
        return new Response(
            'updating article' . $article->getId()
        );
    }

    #[Route('/delete/{id}', name: 'delete_article')]
    public function deleteArticle(Article $article): Response
    {
        return new Response(
            'delete article' . $article->getId()
        );
    }
}
