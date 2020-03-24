<?php

namespace App\Command\Handler;

use App\Command\ReadArticleResult;
use App\Repository\ArticleRepository;
use App\Entity\Article;

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
     * {@inheritdoc}
     */
    public function handle($command): ?Article
    {
        return $this->repository->findOneBySlug($command->slug);
    }
}
