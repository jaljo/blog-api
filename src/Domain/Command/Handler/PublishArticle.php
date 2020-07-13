<?php

namespace App\Domain\Command\Handler;

use App\Domain\Model\Article;
use App\Domain\Command\PublishArticle as PublishArticleCommand;
use App\Domain\Exception\ResourceNotFoundException;
use Doctrine\Common\Persistence\ObjectManager;

class PublishArticle
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(
        ObjectManager $manager
    ) {
        $this->manager = $manager;
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function __invoke(PublishArticleCommand $command): Article
    {
        $article = $command->getArticle();
        $article->publish();

        $this->manager->persist($article);
        $this->manager->flush();

        return $article;
    }
}
