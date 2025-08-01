<?php

namespace App\Controller\admin;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class AdminGenreController extends AbstractController
{
    #[Route('/admin/genre', name: 'app_admin_genre')]
    public function index(GenreRepository $genreRepository, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $genreRepository->getAll(),
            $request->query->getInt('page', 1), /* page number */
            10 /* limit per page */
        );
        $pagination->setCustomParameters([
            'align' => 'center',
        ]);

        return $this->render('admin_genre/index.html.twig', [
            'controller_name' => 'AdminGenreController',
            'genres' => $pagination
        ]);
    }

    #[Route('/admin/genre/show/{slug}', name: 'app_admin_show_genre')]
    public function show(string $slug, GenreRepository $genreRepository): Response
    {
        $genre = $genreRepository->findOneBy(['slug' => $slug]);

        return $this->render('admin_genre/show_genre.html.twig', [
            'controller_name' => 'AdminGenreController',
            'genre' => $genre
        ]);
    }

    #[Route('/admin/genre/add', name: 'app_admin_add_genre', methods: ['POST', 'GET'])]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $genre = new Genre();
        $form = $this->createForm(AddGenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($genre->getLabel())->lower();
            $genre->setSlug($slug);
            $em->persist($genre);
            $em->flush();

            $this->addFlash('success', 'Genre ajouté avec success !');
            return $this->redirectToRoute('app_admin_genre');
        }

        return $this->render('admin_genre/add_genre.html.twig', [
            'controller_name' => 'AdminGenreController',
            'form' => $form
        ]);
    }

    #[Route('/admin/genre/edit/{slug}', name: 'app_admin_edit_genre')]
    public function edit(string $slug, GenreRepository $genreRepository, Request $request, EntityManagerInterface $em): Response
    {
        $genre = $genreRepository->findOneBy(['slug' => $slug]);
        $form = $this->createForm(AddGenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($genre);
            $em->flush();

            $this->addFlash('success', 'Genre modifié avec success !');
            return $this->redirectToRoute('app_admin_genre');
        }

        return $this->render('admin_genre/edit_genre.html.twig', [
            'controller_name' => 'AdminGenreController',
            "form" => $form
        ]);
    }

    #[Route('/admin/genre/delete/{id}', name: 'app_admin_delete_genre')]
    public function delete(int $id, EntityManagerInterface $em): Response
    {
        $genre = $em->getRepository(Genre::class)->find($id);

        if (!$genre) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        } else {
            $em->remove($genre);
            $em->flush();
            $this->addFlash('success', 'Genre supprimé avec success !');
            return $this->redirectToRoute('app_admin_genre');
        }
    }
}
