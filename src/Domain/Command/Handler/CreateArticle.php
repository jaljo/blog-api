<?php

namespace App\Domain\Command\Handler;

use App\Domain\Article;
use App\Domain\Command\CreateArticleResult;
use Ausi\SlugGenerator\SlugGeneratorInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CreateArticle implements CommandHandler
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var SlugGeneratorInterface
     */
    private $slugGenerator;

    public function __construct(
        ObjectManager $manager,
        SlugGeneratorInterface $slugGenerator
    ) {
        $this->manager = $manager;
        $this->slugGenerator = $slugGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($command): ?Article
    {
        $article = Article::write(
            $command->getTitle(),
            $command->getContent(),
            $this->slugGenerator->generate($command->getTitle())
        );

        $this->manager->persist($article);
        $this->manager->flush();

        return $article;
    }
}
