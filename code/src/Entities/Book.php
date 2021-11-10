<?php

namespace App\Entities;

use http\Exception\InvalidArgumentException;

class Book
{
    private ?int $id;
    private string $title;
    private string $author;
    private int $numberOfPages;
    private int $year;
    private float $price;

    public function __construct(array $bookArray)
    {
        $this->setId($bookArray['id'] ?? null);
        $this->setTitle($bookArray['title']);
        $this->setAuthor($bookArray['author']);
        $this->setNumberOfPages($bookArray['number_of_pages']);
        $this->setYear($bookArray['year']);
        $this->setPrice($bookArray['price']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        if ($id < 0) {
            throw new InvalidArgumentException();
        }

        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        if (strlen($title) == 0) {
            throw new InvalidArgumentException();
        }

        $this->title = $title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        if (strlen($author) == 0) {
            throw new InvalidArgumentException();
        }

        $this->author = $author;
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }

    public function setNumberOfPages(int $numberOfPages): void
    {
        if ($numberOfPages < 1) {
            throw new InvalidArgumentException();
        }

        $this->numberOfPages = $numberOfPages;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        if ($price < 1) {
            throw new InvalidArgumentException();
        }

        $this->price = $price;
    }
}
