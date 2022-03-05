<?php

namespace App;

use App\Application\CinemaSessionRepositoryInterface;
use DI\Container;
use DI\ContainerBuilder;
use Exception;

class App
{
    private Container $container;
    private CinemaSessionRepositoryInterface $cinemaSessionRepository;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container =
            (new ContainerBuilder())->addDefinitions('config/config.php')
                                    ->build();
        $this->cinemaSessionRepository =
            $this->container->get(CinemaSessionRepositoryInterface::class);
    }

    public function run(): void
    {
        $sessions = $this->cinemaSessionRepository->findAll();
        if (!empty($sessions)) {
            printf(
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
