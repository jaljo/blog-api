<?php

namespace App\Command;

class ListArticlesResult implements CommandResult
{
    /**
     * @var iterable
     */
    private $result;

    public function __construct(iterable $articles)
    {
        $this->result = $articles;
    }

    public function getResult(): iterable
    {
        return $this->result;
    }
}
