<?php

namespace App\Domain\Command\Handler;

use App\Domain\Command\CreateArticleResult;
use App\Domain\Article;
use Ausi\SlugGenerator\SlugGenerator;
use Doctrine\Common\Persistence\ObjectManager;

class CreateArticle implements CommandHandler
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
     * {@inheritdoc}
     */
    public function handle($command): ?Article
    {
        // @TODO this should rather be injected
        $generator = new SlugGenerator();

        $article = Article::write(
            $command->getTitle(),
            $command->getContent(),
            $generator->generate($command->getTitle())
        );

        $this->manager->persist($article);
        $this->manager->flush();

        return $article;
    }
}