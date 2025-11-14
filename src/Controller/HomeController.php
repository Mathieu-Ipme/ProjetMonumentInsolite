<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\CountryRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use function Symfony\Component\Clock\now;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ArticleRepository $articleRepository,
        GenreRepository $genreRepository,
        CountryRepository $countryRepository,
        CommentRepository $commentRepository,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher,
        PaginatorInterface $paginator,

Request $request,
    ): Response
    {

        //        /** @var User $user */
//        $user = $this->getUser();
//        if ($user === null) {
//            return $this->redirectToRoute('app_login');
////            dump('je suis pas connecté !');
//        }
//       $user = new User();
//       $user->setEmail('toto@toto.fr')
//             ->setName('tata')
//           ->setNickname('tata')
//           ->setPassword($hasher->hashPassword($user, 'totato'))
//           ->setCreatedAt(date_create_immutable())
//           ->setRoles([]);
//       $em->persist($user);
//       $em->flush();


        $lastTwoArticles = $articleRepository->findBy(
            [],
            ['publishedAt' => 'DESC'],
            2
        );

        $NextArticles = $articleRepository->findBy(
            [],
            ['publishedAt' => 'ASC']
        );
//
//        dd($lastThreeArticles);

//        $article = $paginator->paginate(
//            $articleRepository->findAll(),
//            $request->query->getInt('page', 1),
//            6);

        return $this->render('home/index.html.twig', [

            'lastTwoArticles' => $lastTwoArticles,
            'NextArticles' => $NextArticles,
//            'article' => $article

        ]);


    }


}
