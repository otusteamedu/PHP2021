<?php

namespace App\IdentityMaps;

use App\Entities\Book;
use App\Mappers\BookMapper;

class BookIdentityMap
{
    private static array $books = [];

    public function __construct(private BookMapper $bookMapper)
    {

    }

    public function all(): array
    {
        return static::$books = array_map(
            function($book) {
                return [$book->getId() => $book];
            },
            $this->bookMapper->all()
        );
    }

    public function find(int $id): ?Book
    {
        if (!$book = static::$books[$id] ?? false) {
            $book = $this->bookMapper->find($id);
            static::$books[$id] = $book;
        }

        return $book;
    }

    public function store(Book $book): bool
    {
        if ($this->bookMapper->insert($book)) {
            static::$books[$book->getId()] = $book;
            return true;
        }

        return false;
    }

    public function update(Book $book): bool
    {
        if ($this->bookMapper->update($book)) {
            static::$books[$book->getId()] = $book;
            return true;
        }

        return false;
    }

    public function delete(Book $book): bool
    {
        if ($this->bookMapper->delete($book)) {
            unset(static::$books[$book->getId()]);
            return true;
        }

        return false;
    }
}
