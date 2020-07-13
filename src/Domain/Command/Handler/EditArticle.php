<?php

namespace App\Domain\Command\Handler;

use App\Domain\Model\Article;
use App\Domain\Command\EditArticle as EditArticleCommand;
use Doctrine\Common\Persistence\ObjectManager;

class EditArticle
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

    public function __invoke(EditArticleCommand $command): Article
    {
        $article = $command->getArticle();
        $article->edit(
            $command->getTitle(),
            $command->getContent()
        );

        $this->manager->persist($article);
        $this->manager->flush();

        return $article;
    }
}
