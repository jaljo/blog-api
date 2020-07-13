<?php

namespace App\Domain\Command;

use App\Domain\Model\Article;

class EditArticle
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->title = $article->getTitle();
        $this->content = $article->getContent();
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
