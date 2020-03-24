<?php

namespace App\Application\JsonDefinition;

use App\Entity\Article as ArticleEntity;
use DateTime;

class Article
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $dateCreation;

    /**
     * @var bool
     */
    public $draft;

    public function __construct(ArticleEntity $article)
    {
        $this->id = $article->getId();
        $this->title = $article->getTitle();
        $this->slug = $article->getSlug();
        $this->content = $article->getContent();
        $this->dateCreation = $article->getDateCreation()->format('c');
        $this->draft = $article->isDraft();
    }
}
