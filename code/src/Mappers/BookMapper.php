<?php

namespace App\Mappers;

use App\Entities\Book;
use App\IdentityMaps\BookIdentityMap;
use PDO;
use PDOStatement;

class BookMapper
{
    private const QUERY_ALL = "SELECT * FROM books";

    private const QUERY_FIND = 'SELECT * FROM books where id = ?';

    private const QUERY_INSERT = 'INSERT INTO books (title, author, year, number_of_pages, price) 
                                  VALUES (?, ?, ?, ?, ?)';

    private const QUERY_UPDATE = 'UPDATE books set title = ?, author = ?, year = ?, number_of_pages = ?, price = ?
                                  WHERE id = ?';

    private const QUERY_DELETE = 'DELETE FROM books where id = ?';

    private PDOStatement $allStatement;
    private PDOStatement $findStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct(private PDO $connection, private BookIdentityMap $bookIdentityMap)
    {
        $this->allStatement = $this->connection->prepare(self::QUERY_ALL);
        $this->findStatement = $this->connection->prepare(self::QUERY_FIND);
        $this->insertStatement = $this->connection->prepare(self::QUERY_INSERT);
        $this->updateStatement = $this->connection->prepare(self::QUERY_UPDATE);
        $this->deleteStatement = $this->connection->prepare(self::QUERY_DELETE);
    }

    public function all(): array
    {
        $this->allStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->allStatement->execute();

        if (!$rows = $this->allStatement->fetchAll()) {
            return [];
        }

        return array_map(function ($row) {
            $book = new Book([
                'id' => $row['id'],
                'title' => $row['title'],
                'author' => $row['author'],
                'year' => $row['year'],
                'number_of_pages' => $row['number_of_pages'],
                'price' => $row['price'],
            ]);

            $this->bookIdentityMap->store($book);

            return $book;
        }, $rows);
    }

    public function find(int $id): ?Book
    {
        if ($book = $this->bookIdentityMap->find($id)) {
            return $book;
        }

        $this->findStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->findStatement->execute([$id]);

        if (!$row = $this->findStatement->fetch()) {
            return null;
        }

        $book = new Book([
            'id' => $row['id'],
            'title' => $row['title'],
            'author' => $row['author'],
            'year' => $row['year'],
            'number_of_pages' => $row['number_of_pages'],
            'price' => $row['price'],
        ]);

        $this->bookIdentityMap->store($book);
        return $book;
    }

    public function insert(Book $book): bool
    {
        $result = $this->insertStatement->execute([
            $book->getTitle(),
            $book->getAuthor(),
            $book->getYear(),
            $book->getNumberOfPages(),
            $book->getPrice(),
        ]);

        if ($result) {
            $this->bookIdentityMap->store($book);
        }

        return $result;
    }

    public function update(Book $book): bool
    {
        $result = $this->updateStatement->execute([
            $book->getTitle(),
            $book->getAuthor(),
            $book->getYear(),
            $book->getNumberOfPages(),
            $book->getPrice(),
            $book->getId(),
        ]);

        if ($result) {
            $this->bookIdentityMap->update($book);
        }

        return $result;
    }

    public function delete(Book $book):bool
    {
        $result = $this->deleteStatement->execute([
            $book->getId(),
        ]);

        if ($result) {
            $this->bookIdentityMap->delete($book);
        }

        return $result;
    }
}
