<?php

namespace App\Domain\Command\Handler;

use App\Application\Repository\ArticleRepository;
use App\Domain\Command\ListArticlesResult;

class ListArticles implements CommandHandler
{
    /**
     * @var ServiceEntityRepository
     */
    private $repository;

    // @TODO this should depend on an abstraction, not a concrete implementation
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($command): iterable
    {
        return $this->repository->findAllPublished();
    }
}
