<?php

namespace App\Command\Handler;

use App\Command\ListArticlesResult;
use App\Repository\ArticleRepository;

class ListArticles implements CommandHandler
{
    /**
     * @var ServiceEntityRepository
     */
    private $repository;

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
