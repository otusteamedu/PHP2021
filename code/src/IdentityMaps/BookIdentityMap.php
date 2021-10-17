<?php

namespace App\IdentityMaps;

use App\Entities\Book;
use App\Mappers\BookMapper;

class BookIdentityMap
{
    private static array $books = [];

    public function __construct()
    {

    }

    public function all(): array
    {
        return static::$books;
    }

    public function find(int $id): ?Book
    {
        return static::$books[$id] ?? null;
    }

    public function store(Book $book): void
    {
        static::$books[$book->getId()] = $book;
    }

    public function update(Book $book): void
    {
        static::$books[$book->getId()] = $book;
    }

    public function delete(Book $book): void
    {
        unset(static::$books[$book->getId()]);
    }
}
