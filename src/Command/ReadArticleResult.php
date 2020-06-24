<?php

namespace App\Command;

use App\Entity\Article;

class ReadArticleResult implements CommandResult
{
    /**
     * @var Article|null
     */
    private $result;

    public function __construct(?Article $article)
    {
        $this->result = $article;
    }

    public function getResult(): ?Article
    {
        return $this->result;
    }
}
