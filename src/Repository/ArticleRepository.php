<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

//    public function getAll()
//    {
//        //equivalent : SELECT * FROM article
//        return $this->createQueryBuilder('a')
//            ->orderBy('a.id', 'ASC');
//    }

    public function findByGenre(Genre $genre, int $limit = null): array
    {
        $qb = $this->createQueryBuilder('a')
            ->join('a.genres', 'c')
            ->where('c = :gen')
            ->setParameter('gen', $genre);

        if ($limit !== null) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }

    public function getAll(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC');
    }

    public function findArticleByCountry(string $country, int $limit = null): array
    {
        $qb = $this->createQueryBuilder('a')
            ->join('a.countries', 'c')
            ->where('c.slug = :country')
            ->setParameter('country', $country);

        if($limit !== null) {
            $qb->setMaxResults($limit);
        }
        return $qb->getQuery()->getResult();
    }
    //    /**
    //     * @return Article[] Returns an array of Article objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Article
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
