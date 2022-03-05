<?php

namespace App\Domain;

use App\Application\CinemaMovieRepositoryInterface;
use App\Application\CinemaScreenRepositoryInterface;
use DateTimeInterface;

class CinemaSession
{
    private int $id;
    private int $movieId;
    private int $screenId;
    private DateTimeInterface $session_start;

    private ?CinemaMovie $movie = null;
    private ?CinemaScreen $screen = null;

    private CinemaMovieRepositoryInterface $cinemaMovieRepository;
    private CinemaScreenRepositoryInterface $cinemaScreenRepository;

    /**
     * @param int                             $id
     * @param int                             $movieId
     * @param int                             $screenId
     * @param DateTimeInterface               $session_start
     * @param CinemaMovieRepositoryInterface  $cinemaMovieRepository
     * @param CinemaScreenRepositoryInterface $cinemaScreenRepository
     */
    public function __construct(
        int $id,
        int $movieId,
        int $screenId,
        DateTimeInterface $session_start,
        CinemaMovieRepositoryInterface $cinemaMovieRepository,
        CinemaScreenRepositoryInterface $cinemaScreenRepository
    ) {
        $this->id = $id;
        $this->movieId = $movieId;
        $this->screenId = $screenId;
        $this->session_start = $session_start;

        $this->cinemaMovieRepository = $cinemaMovieRepository;
        $this->cinemaScreenRepository = $cinemaScreenRepository;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * @return int
     */
    public function getScreenId(): int
    {
        return $this->screenId;
    }

    /**
     * @return DateTimeInterface
     */
    public function getSessionStart(): DateTimeInterface
    {
        return $this->session_start;
    }

    /**
     * @return CinemaMovie
     */
    public function getMovie(): CinemaMovie
    {
        if (is_null($this->movie)) {
            $this->movie =
                $this->cinemaMovieRepository->findById($this->movieId);
        }

        return $this->movie;
    }

    /**
     * @return CinemaScreen
     */
    public function getScreen(): CinemaScreen
    {
        if (is_null($this->screen)) {
            $this->screen =
                $this->cinemaScreenRepository->findById($this->screenId);
        }

        return $this->screen;
    }
}
