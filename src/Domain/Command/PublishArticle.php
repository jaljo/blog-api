<?php

namespace App\Domain\Command;

use App\Domain\Model\Article;

class PublishArticle
{
    /**
     * @var Article
     */
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}
