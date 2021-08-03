<?php

namespace App\Event\UseCase;


use App\Event\Repository\EventRepositoryInterface;

class UseCase
{
    protected EventRepositoryInterface $rep;

    public function __construct(EventRepositoryInterface $rep)
    {
        $this->rep = $rep;
    }

    public function add(int $priority, array $conditions, array $event)
    {
        return $this->rep->add($priority, $conditions, $event);
    }

    public function findHighPriorityEvent($conditions): ?array
    {
        return $this->rep->findHighPriorityEvent($conditions);
    }

    public function findAllEvent($conditions): array
    {
        return $this->rep->findAllEvent($conditions);
    }

    public function flush()
    {
        return $this->rep->flush();
    }
}