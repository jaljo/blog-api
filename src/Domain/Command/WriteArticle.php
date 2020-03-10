<?php

namespace App\Domain\Command;

class WriteArticle
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
