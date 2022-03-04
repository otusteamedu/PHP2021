<?php

namespace App\Infrastructure;

use App\Application\CinemaScreenRepositoryInterface;
use App\Domain\CinemaScreen;
use PDO;
use PDOStatement;

class CinemaScreenRepository implements CinemaScreenRepositoryInterface
{
    private PDOStatement $selectAllStatement;
    private PDOStatement $selectOneStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectAllStatement = $pdo->prepare(
            'SELECT * FROM cinema_screens'
        );
        $this->selectOneStatement = $pdo->prepare(
            'SELECT * FROM cinema_screens WHERE id = ?'
        );
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO cinema_screens (id, name, max_seats) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE cinema_screens SET name = ?, max_seats = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM cinema_screens WHERE id = ?'
        );
    }

    /**
     * @return CinemaScreen[]
     */
    public function findAll(): array
    {
        $this->selectAllStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectAllStatement->execute();
        $items = $this->selectAllStatement->fetchAll();

        return array_map(
            fn($item) => new CinemaScreen(
                $item['id'], $item['name'], $item['max_seats']
            ),
            $items
        );
    }

    public function findById(int $id): ?CinemaScreen
    {
        $this->selectOneStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectOneStatement->execute([$id]);
        $item = $this->selectOneStatement->fetch();
        if ($item === false) {
            return null;
        }

        return new CinemaScreen(
            $item['id'], $item['name'], $item['max_seats']
        );
    }

    public function create(int $id, string $name, int $maxSeats): CinemaScreen
    {
        $this->insertStatement->execute([$id, $name, $maxSeats]);

        return new CinemaScreen($id, $name, $maxSeats);
    }

    public function update(CinemaScreen $screen): bool
    {
        return $this->updateStatement->execute(
            [$screen->getName(), $screen->getMaxSeats(), $screen->getId()]
        );
    }

    public function delete(CinemaScreen $screen): bool
    {
        return $this->deleteStatement->execute([$screen->getId()]);
    }
}
