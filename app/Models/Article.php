<?php

namespace App\Models;

class Article
{
    private ?string $author;
    private string $title;
    private string $url;
    private string $description;
    private string $publishedAt;
    private ?string $picture;

    public function __construct(
        ?string $author,
        string  $title,
        string  $url,
        string  $description,
        string  $publishedAt,
        ?string $picture = null
    )
    {
        $this->author = $author;
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->publishedAt = $publishedAt;
        $this->picture = $picture;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }
}
