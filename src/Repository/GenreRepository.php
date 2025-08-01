<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Genre>
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }
    public function findFullBySlug(string $slug): ?Genre
    {
        return $this->createQueryBuilder('g') // SELECT g.* FROM genre g
        ->select('g', 'a') // SELECT g.*, a.*
        ->join('g.articles', 'a') // JOIN article_genre + JOIN article a
        ->where('g.slug = :slug') // WHERE c.slug = ?
        ->setParameter('slug', $slug) // ADD PARAMETER 0, $slug
//        ->orderBy('g.price', 'DESC') // ORDER BY g.price DESC
        ->getQuery() // MET EN FORME LA REQUETE POUR L'EXECUTER
        ->getOneOrNullResult(); // EXECUTE LA REQUETE (Le oneOrNullResult fait secrètement un LIMIT 1)
    }
    //    /**
    //     * @return Genre[] Returns an array of Genre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Genre
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
