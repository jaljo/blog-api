<?php

namespace App\Domain\Command\Handler;

use App\Domain\Command\ListArticles as ListArticlesCommand;
use App\Domain\Repository\ArticleRepository;

class ListArticles
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ListArticlesCommand $command): iterable
    {
        return $this->repository->findAllPublished();
    }
}
