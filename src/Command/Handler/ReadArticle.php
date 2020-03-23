<?php

namespace App\Command\Handler;

use App\Command\CommandResult;
use App\Command\ReadArticleResult;
use App\Repository\ArticleRepository;

class ReadArticle implements CommandHandler
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
     * @param mixed $command
     */
    public function handle($command): CommandResult
    {
        $article = $this->repository->findOneBySlug($command->slug);

        return new ReadArticleResult($article);
    }
}
