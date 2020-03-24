<?php

namespace App\Application\Repository;

use App\Domain\Article;
use App\Domain\Repository\ArticleRepository as ArticleRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findAllPublished(): iterable
    {
        return $this->createQueryBuilder('a')
            ->where('a.draft = false')
            ->orderBy('a.dateCreation', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
