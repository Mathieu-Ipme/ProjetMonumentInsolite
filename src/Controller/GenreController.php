<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\ArticleRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/genre')]
final class GenreController extends AbstractController
{

    // attention route en cours d'

    #[Route('/genres/{slug}', name: 'app_genre')]
    public function genre(string $slug, GenreRepository $genreRepository): Response
    {

        $genre = $genreRepository->findOneBy(['slug' => $slug]);


        if ($genre === null) {
            $this->addFlash('danger', 'Cette catégorie n\'existe pas !');
            return $this->redirectToRoute('app_home');
        }


        return $this->render('genre/index.html.twig', [
//            'controller_name' => 'GenreController',
            'genre' => $genre,
            'slug' => ucfirst($slug),
//            'genre' => $genre
        ]);
    }

}
