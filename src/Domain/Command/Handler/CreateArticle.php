<?php

namespace App\Domain\Command\Handler;

use App\Domain\Article;
use App\Domain\Command\CreateArticle as CreateArticleCommand;
use Ausi\SlugGenerator\SlugGeneratorInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CreateArticle
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

    public function __invoke(CreateArticleCommand $command): Article
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
