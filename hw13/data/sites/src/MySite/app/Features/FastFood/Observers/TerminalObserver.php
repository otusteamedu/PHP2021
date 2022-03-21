<?php


namespace MySite\app\Features\FastFood\Observers;


use SplObserver;
use SplSubject;

class TerminalObserver implements SplObserver
{

    /**
     * @var array
     */
    private array $log = [];

    /**
     * @inheritDoc
     */
    public function update(SplSubject $subject, ?int $status = null)
    {
        $this->log[] = date("Y-m-d H:i:s") . '. Event ' . $status . ' happened';
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }
}
