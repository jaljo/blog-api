<?php

namespace App\Command\Handler;

use App\Command\Command;
use App\Command\CommandResult;
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

    public function handle(Command $command): CommandResult
    {
        $articles = $this->repository->findAllPublished();

        return new ListArticlesResult($articles);
    }
}
