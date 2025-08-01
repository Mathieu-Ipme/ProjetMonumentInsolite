<?php

namespace App\Controller\admin;

use App\Entity\Article;
use App\Form\AddArticleType;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class AdminArticleController extends AbstractController
{
    #[Route('/admin/article', name: 'app_admin_article')]
    public function index(ArticleRepository $articleRepository, EntityManagerInterface $em,PaginatorInterface $paginator, Request $request):
    Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $articles = $articleRepository->findAll();
          dump($articles);

//        $pagination = $paginator->paginate(
//           $articleRepository->getAll(),
//           $request->query->getInt('page', 1), /* page number */
//            5 /* limit per page */
//        );
//       $pagination->setCustomParameters([
//            'align' => 'center',
//        ]);

       return $this->render('admin_article/index.html.twig', [
////            'controller_name' => 'AdminArticleController',
            'articles' => $articles
//              'maxPage' => $maxPage,
//               'page' => $page
        ]);
    }

    #[Route('/admin/article/show/{slug}', name: 'app_admin_show_article')]
    public function show(string $slug, ArticleRepository $articleRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $article = $articleRepository->findOneBy(['slug' => $slug]);

        return $this->render('admin_article/show_article.html.twig', [
            'controller_name' => 'AdminArticleController',
            'article' => $article
        ]);
    }

    #[Route('/admin/article/add', name: 'app_admin_add_article', methods: ['POST', 'GET'])]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {

        $user = $this->getUser();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $article = new Article();
        $form = $this->createForm(AddArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //add slug

            $slug = $slugger->slug($article->getTitle())->lower();
            $article->setSlug($slug);

            //add user
            $article->setOwner($user);

            //publishedAt
            $article->setPublishedAt(new \DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article ajouté avec success !');
            return $this->redirectToRoute('app_admin_article');
        }

        return $this->render('admin_article/add_article.html.twig', [
            'controller_name' => 'AdminArticleController',
            'form' => $form
        ]);
    }

    #[Route('/admin/article/edit/{slug}', name: 'app_admin_edit_article')]
    public function edit(string $slug, ArticleRepository $articleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        $form = $this->createForm(AddArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article modifié avec success !');
            return $this->redirectToRoute('app_admin_article');
        }

        return $this->render('admin_article/edit_article.html.twig', [
            'controller_name' => 'AdminArticleController',
            "form" => $form
        ]);
    }

    #[Route('/admin/article/delete/{id}', name: 'app_admin_delete_article')]
    public function delete(int $id, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
//        $user = $this->getUser();

        $article = $em->getRepository(Article::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        } else {
            $em->remove($article);
            $em->flush();
            $this->addFlash('success', 'Article supprimé avec success !');
            return $this->redirectToRoute('app_admin_article');
        }
    }
}
