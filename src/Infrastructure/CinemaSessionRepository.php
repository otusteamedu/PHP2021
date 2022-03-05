<?php

namespace App\Infrastructure;

use App\Application\CinemaMovieRepositoryInterface;
use App\Application\CinemaScreenRepositoryInterface;
use App\Application\CinemaSessionRepositoryInterface;
use App\Domain\CinemaSession;
use DateTime;
use DateTimeInterface;
use Exception;
use PDO;
use PDOStatement;

class CinemaSessionRepository implements CinemaSessionRepositoryInterface
{
    private PDO $pdo;
    private PDOStatement $selectAllStatement;
    private PDOStatement $selectOneStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    private CinemaMovieRepositoryInterface $cinemaMovieRepository;
    private CinemaScreenRepositoryInterface $cinemaScreenRepository;

    public function __construct(
        PDO $pdo,
        CinemaMovieRepositoryInterface $cinemaMovieRepository,
        CinemaScreenRepositoryInterface $cinemaScreenRepository
    ) {
        $this->pdo = $pdo;
        $this->selectAllStatement = $pdo->prepare(
            'SELECT * FROM cinema_sessions'
        );
        $this->selectOneStatement = $pdo->prepare(
            'SELECT * FROM cinema_sessions WHERE id = ?'
        );
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO cinema_sessions (movie_id, screen_id, session_start) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE cinema_sessions SET movie_id = ?, screen_id = ?, session_start = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM cinema_sessions WHERE id = ?'
        );

        $this->cinemaMovieRepository = $cinemaMovieRepository;
        $this->cinemaScreenRepository = $cinemaScreenRepository;
    }

    /**
     * @return CinemaSession[]
     * @throws Exception
     */
    public function findAll(): array
    {
        $this->selectAllStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectAllStatement->execute();
        $items = $this->selectAllStatement->fetchAll();

        return array_map(
            fn($item) => new CinemaSession(
                $item['id'],
                $item['movie_id'],
                $item['screen_id'],
                new DateTime($item['session_start']),
                $this->cinemaMovieRepository,
                $this->cinemaScreenRepository
            ),
            $items
        );
    }

    /**
     * @throws Exception
     */
    public function findById(int $id): ?CinemaSession
    {
        $this->selectOneStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectOneStatement->execute([$id]);
        $item = $this->selectOneStatement->fetch();
        if ($item === false) {
            return null;
        }

        return new CinemaSession(
            $item['id'],
            $item['movie_id'],
            $item['screen_id'],
            new DateTime($item['session_start']),
            $this->cinemaMovieRepository,
            $this->cinemaScreenRepository
        );
    }

    public function create(
        int $movieId,
        int $screenId,
        DateTimeInterface $sessionStart
    ): CinemaSession {
        $this->insertStatement->execute(
            [$movieId, $screenId, $sessionStart->format('Y-m-d H:i:s')]
        );

        return new CinemaSession(
            (int)$this->pdo->lastInsertId(),
            $movieId,
            $screenId,
            $sessionStart,
            $this->cinemaMovieRepository,
            $this->cinemaScreenRepository
        );
    }

    public function update(CinemaSession $session): bool
    {
        return $this->updateStatement->execute([
                                                   $session->getMovieId(),
                                                   $session->getScreenId(),
                                                   $session->getSessionStart()
                                                           ->format('Y-m-d H:i:s'),
                                                   $session->getId(),
                                               ]);
    }

    public function delete(CinemaSession $session): bool
    {
        return $this->deleteStatement->execute([$session->getId()]);
    }
}
