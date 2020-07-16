<?php

namespace App\Domain\Command\Handler;

use App\Domain\Command\ReadArticle as ReadArticleCommand;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Article;
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

    /**
     * @throws ResourceNotFoundException
     */
    public function __invoke(ReadArticleCommand $command): Article
    {
        $id = $command->getId();

        $article = is_numeric($id)
            ? $this->repository->findOneById($id)
            : $this->repository->findOneBySlug($id)
        ;

        if ($article === null) {
            throw new ResourceNotFoundException();
        }

        return $article;
    }
}
