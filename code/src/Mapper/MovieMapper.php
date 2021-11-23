<?php

namespace App\Mapper;
use App\Postgresql\ConnectPDO;
use App\Mapper\Movie;

class MovieMapper
{
    private $pdo;
    private $all;
    private $select;
    private $insert;
    private $update;
    private $delete;

    public function __construct()
    {
        $this->pdo = (new ConnectPDO())->Connect();

        $this->all = $this->pdo->prepare(
            'SELECT * FROM public.sessions'
        );

        $this->select = $this->pdo->prepare(
            'SELECT * FROM public.sessions WHERE id = ?'
        );

        $this->insert = $this->pdo->prepare(
            'INSERT INTO public.sessions (start_time, start_end, id_hall, movie, price) VALUES (?, ?, ?, ?, ?)'
        );

        $this->update = $this->pdo->prepare(
            'UPDATE public.sessions SET start_time = ?, start_end = ?, id_hall = ?, movie = ?, price = ? WHERE id = ?'
        );

        $this->delete = $this->pdo->prepare(
            'DELETE FROM public.sessions WHERE id = ?'
        );

    }

    public function all(): array
    {
        $this->all->execute();
        $results = $this->all->fetchAll();
        
        foreach ($results as $result) {
            $movie[] = new Movie(
                $result['id'],
                $result['start_time'],
                $result['start_end'],
                $result['id_hall'],
                $result['movie'],
                $result['price']
            );
        }

        return $movie;
    }

    public function search(int $id): Movie
    {

        $this->select->execute([$id]);
        $result = $this->select->fetch();

        return $movie = new Movie(
            $result['id'],
            $result['start_time'],
            $result['start_end'],
            $result['id_hall'],
            $result['movie'],
            $result['price']
        );

    }

    public function insert(array $rawData): Movie
    {
        $this->insert->execute([
            $rawData['start_time'],
            $rawData['start_end'],
            $rawData['id_hall'],
            $rawData['movie'],
            $rawData['price']
        ]);

        return new Movie(
            $this->pdo->lastInsertId(),
            $rawData['start_time'],
            $rawData['start_end'],
            $rawData['id_hall'],
            $rawData['movie'],
            $rawData['price']
        );
    }

    public function update(Movie $movie): bool
    {
        return $this->update->execute([
            $movie->getStartTime(),
            $movie->getStartEnd(),
            $movie->getIdHall(),
            $movie->getMovie(),
            $movie->getPrice(),
            $movie->getId()
        ]);
    }

    public function delete(Movie $movie): bool
    {
        return $this->delete->execute([
            $movie->getId(),
        ]);
    }

}