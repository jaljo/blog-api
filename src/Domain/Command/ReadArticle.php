<?php

namespace App\Domain\Command;

class ReadArticle
{
    /**
     * @var int|string
     */
    private $slug;

    /**
     * @param int|string
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }
}
