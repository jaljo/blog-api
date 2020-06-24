<?php

namespace App\Command;

class ReadArticle implements Command
{
    /**
     * @var string
     */
    public $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }
}
