<?php

namespace App;

class App
{
    private $app;

    public function run($appType)
    {
        /* Позволяет скрипту ожидать соединения бесконечно. */
        set_time_limit(0);
        /* Включает скрытое очищение вывода так, что мы видим данные как только они появляются. */
        ob_implicit_flush();

        try {
            if ($appType === 'server') {
                $this->app = new Server();
            } elseif ($appType === 'client') {
                $this->app = new Client();
            }

            $this->app->run();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}