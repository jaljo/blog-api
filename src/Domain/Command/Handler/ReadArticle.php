<?php

namespace App\Domain\Command\Handler;

use App\Domain\Command\ReadArticleResult;
use App\Repository\ArticleRepository;
use App\Domain\Article;

class ReadArticle implements CommandHandler
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
    public function handle($command): ?Article
    {
        return $this->repository->findOneBySlug($command->getSlug());
    }
}
