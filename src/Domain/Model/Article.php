<?php

namespace App\Domain\Model;

use DateTimeInterface;
use DateTimeImmutable;

class Article
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $content;

    /**
     * @var DateTimeInterface
     */
    private $dateCreation;

    /**
     * @var bool
     */
    private $draft;

    private function __construct(string $title, string $content, string $slug)
    {
        $this->content = $content;
        $this->dateCreation = new DateTimeImmutable();
        $this->draft = true;
        $this->slug = $slug;
        $this->title = $title;
    }

    public static function write(string $title, string $content, string $slug): self
    {
        return new self($title, $content, $slug);
    }

    public function publish(): self
    {
        $this->draft = false;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDateCreation(): DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function isDraft(): bool
    {
        return $this->draft;
    }
}
