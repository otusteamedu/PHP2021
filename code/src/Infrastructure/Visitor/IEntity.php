<?php
declare(strict_types=1);

namespace App\Infrastructure\Visitor;


interface IEntity
{
    public function accept(IVisitor $visitor): string;
}