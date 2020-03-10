<?php

namespace App\Domain\Command\Handler;

use App\Domain\Model\Article;
use App\Domain\Command\WriteArticle as WriteArticleCommand;
use Ausi\SlugGenerator\SlugGeneratorInterface;
use Doctrine\Common\Persistence\ObjectManager;

class WriteArticle
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

    public function __invoke(WriteArticleCommand $command): Article
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
