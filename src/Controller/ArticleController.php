<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CountryRepository;
use App\Repository\GenreRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{


    #[Route('/articles/{slug}', name: 'app_show_article')]
    public function show(string                 $slug,
                          ArticleRepository      $articleRepository,
//                          CountryRepository      $countryRepository,
//                          GenreRepository        $genreRepository,
                          CommentRepository      $commentRepository,
                          Request                $request,
                          EntityManagerInterface $entityManager,
//                         UserRepository         $userRepository,
    ): Response
    {
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        if ($article === null) {
            // Utilisable seulement dans un controller !
            $this->addFlash('danger', 'Ce monument n\'existe pas !');
            return $this->redirectToRoute('app_home');
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setArticle($article);
//            $comment->setUser($userRepository->findOneBy(['id' => 42]));
            $comment->setCreatedAt(new \DateTime());
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_show_article', [
                'slug' => $article->getSlug()
            ]);
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'form' => $form,
            'comments' => $commentRepository->findBy(['article' => $article], ['createdAt' => 'DESC'], 3),
        ]);
    }

    #[Route('/genre/{slug}', name: 'app_article_genre')]
    public function articleGenre(
        string             $slug,
        GenreRepository $GenreRepository
    ): Response
    {
        $genre = $GenreRepository->findFullBySlug($slug);
        if ($genre === null) {
            $this->addFlash('danger', 'Ce genre n\'existe pas !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('article/articles_by_genre.html.twig', [
            'genre' => $genre,
        ]);
    }
}
