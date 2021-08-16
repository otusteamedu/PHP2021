<?php
namespace App\Observers;

class Observer implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->state == 1) {
            echo "Изменился статус приготовления продукта: началась готовка";
        }
    }
}