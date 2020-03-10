<?php

namespace App\Domain\Command\Handler;

use App\Domain\Model\Article;
use App\Domain\Command\ReadArticle as ReadArticleCommand;
use App\Domain\Repository\ArticleRepository;

class ReadArticle
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ReadArticleCommand $command): ?Article
    {
        return $this->repository->findOneBySlug($command->getSlug());
    }
}
