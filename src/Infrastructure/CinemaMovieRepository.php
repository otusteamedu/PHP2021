<?php

namespace App\Infrastructure;

use App\Application\CinemaMovieRepositoryInterface;
use App\Domain\CinemaMovie;
use PDO;
use PDOStatement;

class CinemaMovieRepository implements CinemaMovieRepositoryInterface
{
    private PDO $pdo;
    private PDOStatement $selectAllStatement;
    private PDOStatement $selectOneStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectAllStatement = $pdo->prepare(
            'SELECT * FROM cinema_movies'
        );
        $this->selectOneStatement = $pdo->prepare(
            'SELECT * FROM cinema_movies WHERE id = ?'
        );
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO cinema_movies (name_original, name_loc, duration_min) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE cinema_movies SET name_original = ?, name_loc = ?, duration_min = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM cinema_movies WHERE id = ?'
        );
    }

    /**
     * @return CinemaMovie[]
     */
    public function findAll(): array
    {
        $this->selectAllStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectAllStatement->execute();
        $items = $this->selectAllStatement->fetchAll();

        return array_map(
            fn($item) => new CinemaMovie(
                $item['id'],
                $item['name_original'],
                $item['name_loc'],
                $item['duration_min']
            ),
            $items
        );
    }

    public function findById(int $id): ?CinemaMovie
    {
        $this->selectOneStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectOneStatement->execute([$id]);
        $item = $this->selectOneStatement->fetch();
        if ($item === false) {
            return null;
        }

        return new CinemaMovie(
            $item['id'],
            $item['name_original'],
            $item['name_loc'],
            $item['duration_min']
        );
    }

    public function create(
        string $nameOriginal,
        ?string $nameLoc,
        int $durationMin
    ): CinemaMovie {
        $this->insertStatement->execute([$nameOriginal, $nameLoc, $durationMin]
        );

        return new CinemaMovie(
            (int)$this->pdo->lastInsertId(),
            $nameOriginal,
            $nameLoc,
            $durationMin
        );
    }

    public function update(CinemaMovie $movie): bool
    {
        return $this->updateStatement->execute([
                                                   $movie->getNameOriginal(),
                                                   $movie->getNameLoc(),
                                                   $movie->getDurationMin(),
                                                   $movie->getId(),
                                               ]);
    }

    public function delete(CinemaMovie $movie): bool
    {
        return $this->deleteStatement->execute([$movie->getId()]);
    }
}
