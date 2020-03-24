<?php

namespace App\Command\Handler;

use App\Command\CreateArticleResult;
use App\Entity\Article;
use App\Repository\ArticleRepository;
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
            $command->title,
            $command->content,
            $generator->generate($command->title)
        );

        $this->manager->persist($article);
        $this->manager->flush();

        return $article;
    }
}
