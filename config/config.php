<?php

use App\Application\CinemaMovieRepositoryInterface;
use App\Application\CinemaScreenRepositoryInterface;
use App\Application\CinemaSessionRepositoryInterface;
use App\Infrastructure\CinemaMovieRepository;
use App\Infrastructure\CinemaScreenRepository;
use App\Infrastructure\CinemaSessionRepository;

$dsn = sprintf(
    'pgsql:host=%s;port=%s;dbname=%s',
    getenv('LOCAL_HOST'),
    getenv('POSTGRES_PORT'),
    getenv('POSTGRES_DB')
);
$pdoHelper = DI\create(PDO::class)->constructor(
    $dsn,
    getenv('POSTGRES_USER'),
    getenv('POSTGRES_PASSWORD'),
    null
);

return [
    PDO::class                              => $pdoHelper,
    CinemaMovieRepositoryInterface::class   => DI\get(
        CinemaMovieRepository::class
    ),
    CinemaScreenRepositoryInterface::class  => DI\get(
        CinemaScreenRepository::class
    ),
    CinemaSessionRepositoryInterface::class => DI\get(
        CinemaSessionRepository::class
    ),
];
