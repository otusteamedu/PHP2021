<?php
namespace App\Observer;

class Observer implements \SplObserver
{
    private $text = 'Изменился статус приготовления продукта: ';

    public function update(\SplSubject $subject): void
    {

        if ($subject->state == 1) {
            echo $this->text . "началась готовка";
        }

        if ($subject->state == 2) {
            echo $this->text . "осталось совсем чуть-чуть)";
        }

        
        if ($subject->state == 3) {
            echo $this->text . "Заказ готов";
        }
    }
}