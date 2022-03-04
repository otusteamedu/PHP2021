<?php

namespace App;

use App\Application\CinemaSessionRepositoryInterface;

class App
{
    private CinemaSessionRepositoryInterface $cinemaSessionRepository;

    public function __construct(
        CinemaSessionRepositoryInterface $cinemaSessionRepository
    ) {
        $this->cinemaSessionRepository = $cinemaSessionRepository;
    }

    public function run(): void
    {
        $sessions = $this->cinemaSessionRepository->findAll();
        if (!empty($sessions)) {
            echo sprintf(
                'Movie "%s" show in %s screen at %s',
                $sessions[0]->getMovie()
                            ->getNameOriginal(),
                $sessions[0]->getScreen()
                            ->getName(),
                $sessions[0]->getSessionStart()
                            ->format('H:i:s d M Y')
            );
        }
    }
}
