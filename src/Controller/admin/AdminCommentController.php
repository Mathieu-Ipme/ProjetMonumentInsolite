<?php

namespace App\Controller\admin;

use App\Entity\Comment;
use App\Form\AddCommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class AdminCommentController extends AbstractController
{
    #[Route('/admin/comment', name: 'app_admin_comment')]
    public function index(CommentRepository $commentRepository, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $commentRepository->getAll(),
            $request->query->getInt('page', 1), /* page number */
            6 /* limit per page */
        );
        $pagination->setCustomParameters([
            'align' => 'center',
        ]);

        return $this->render('admin_comment/index.html.twig', [
            'controller_name' => 'AdminCommentController',
            'comments' => $pagination
        ]);
    }

//    #[Route('/admin/comment/show/{slug}', name: 'app_admin_show_comment')]
//    public function show(string $slug, CommentRepository $commentRepository): Response
    #[Route('/admin/comment/show/{id}', name: 'app_admin_show_comment')]
    public function show(int $id, CommentRepository $commentRepository): Response
    {
//        $comment = $commentRepository->findOneBy(['slug' => $slug]);  attention à redefinir avec id  (non finie)
        $comment = $commentRepository->findOneBy($id);

        return $this->render('admin_comment/show_comment.html.twig', [
            'controller_name' => 'AdminCommentController',
            'comment' => $comment
        ]);
    }

//    #[Route('/admin/comment/add', name: 'app_admin_add_comment', methods: ['POST', 'GET'])]
//    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
//    {
//        $comment = new Comment();
//        $form = $this->createForm(AddCommentType::class, $comment);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $slug = $slugger->slug($comment->getName())->lower();
//            $comment->setSlug($slug);
//            $em->persist($comment);
//            $em->flush();
//
//            $this->addFlash('success', 'Jeux ajouté avec success !');
//            return $this->redirectToRoute('app_admin_game');
//        }
//
//        return $this->render('admin_game/add_game.html.twig', [
//            'controller_name' => 'AdminGameController',
//            'form' => $form
//        ]);
//    }

//    #[Route('/admin/game/edit/{slug}', name: 'app_admin_edit_game')]
//    public function edit(string $slug, GameRepository $gameRepository, Request $request, EntityManagerInterface $em): Response
//    {
//        $game = $gameRepository->findOneBy(['slug' => $slug]);
//        $form = $this->createForm(AddGameType::class, $game);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em->persist($game);
//            $em->flush();
//
//            $this->addFlash('success', 'Jeux modifié avec success !');
//            return $this->redirectToRoute('app_admin_game');
//        }
//
//        return $this->render('admin_game/edit_game.html.twig', [
//            'controller_name' => 'AdminGameController',
//            "form" => $form
//        ]);
//    }

    #[Route('/admin/comment/delete/{id}', name: 'app_admin_delete_comment')]
    public function delete(int $id, EntityManagerInterface $em): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);

        if (!$comment) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        } else {
            $em->remove($comment);
            $em->flush();
            $this->addFlash('success', 'Commentaire supprimé avec success !');
            return $this->redirectToRoute('app_admin_comment');
        }
    }
}
