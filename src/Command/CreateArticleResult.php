<?php

namespace App\Command;

use App\Entity\Article;

class CreateArticleResult implements CommandResult
{
    /**
     * @var Article
     */
    private $result;

    public function __construct(Article $article)
    {
        $this->result = $article;
    }

    public function getResult(): Article
    {
        return $this->result;
    }
}
