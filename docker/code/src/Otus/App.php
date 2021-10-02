<?php

namespace Otus;

use Otus\PageInterface;

class App implements PageInterface
{
   public function template(): string {
      return 'quest';
   }
}