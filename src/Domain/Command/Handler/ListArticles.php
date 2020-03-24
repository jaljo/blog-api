<?php

namespace App\Domain\Command\Handler;

use App\Domain\Command\ListArticlesResult;
use App\Domain\Repository\ArticleRepository;

class ListArticles implements CommandHandler
{
    /**
     * @var ArticleRepository
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
