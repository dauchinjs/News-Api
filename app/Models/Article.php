<?php

namespace App\Models;

class Article
{
    private string $title;
    private string $url;
    private string $description;
    private string $publishedAt;
    private ?string $author;
    private ?string $picture;

    public function __construct(
        string  $title,
        string  $url,
        string  $description,
        string  $publishedAt,
        ?string $author = null,
        ?string $picture = null
    )
    {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->publishedAt = $publishedAt;
        $this->author = $author;
        $this->picture = $picture;
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }
}