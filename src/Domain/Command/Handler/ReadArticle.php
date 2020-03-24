<?php

namespace App\Domain\Command\Handler;

use App\Domain\Article;
use App\Domain\Command\ReadArticleResult;
use App\Domain\Repository\ArticleRepository;

class ReadArticle implements CommandHandler
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
    public function handle($command): ?Article
    {
        return $this->repository->findOneBySlug($command->getSlug());
    }
}
