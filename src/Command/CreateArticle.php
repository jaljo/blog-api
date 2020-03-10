<?php

namespace App\Command;

class CreateArticle implements Command
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;
}
