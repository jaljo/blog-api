<?php

namespace App\Domain\Command\Handler;

use App\Domain\Command\EditArticle as EditArticleCommand;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Article;
use App\Domain\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;

class EditArticle
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
    public function __invoke(EditArticleCommand $command): Article
    {
        $article = $this->repository->findOneById($command->getId());

        if ($article === null) {
            throw new ResourceNotFoundException();
        }

        $article->edit(
            $command->getTitle(),
            $command->getContent()
        );

        $this->manager->persist($article);
        $this->manager->flush();

        return $article;
    }
}
