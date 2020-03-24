<?php

namespace App\Application\Repository;

use App\Domain\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

// todo this should implement an interface of the domain layer
class ArticleRepository extends ServiceEntityRepository
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
