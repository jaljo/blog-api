<?php

namespace App\Domain\Command\Handler;

use App\Domain\Article;
use App\Domain\Command\PublishArticle as PublishArticleCommand;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;

class PublishArticle
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var ArticleRepository
     */
    private $repository;

    public function __construct(
        ObjectManager $manager,
        ArticleRepository $repository
    ) {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function __invoke(PublishArticleCommand $command): Article
    {
        $article = $this->repository->find($command->getId());

        if (null === $article) {
            throw new ResourceNotFoundException();
        }

        $article->publish();

        $this->manager->persist($article);
        $this->manager->flush();

        return $article;
    }
}
