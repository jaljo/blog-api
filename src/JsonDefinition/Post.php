<?php

namespace App\JsonDefinition;

use DateTime;

class Post
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
    public $seoTitle;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $dateCreation;

    /**
     * @var boolean
     */
    public $draft;

    public function __construct(array $post)
    {
        $this->id = $post['id'];
        $this->title = $post['title'];
        $this->seoTitle = $post['seo_title'];
        $this->content = $post['content'];
        $this->dateCreation = (new DateTime($post['date_creation']))->format('c');
        $this->draft = (bool) $post['draft'];
    }
}
