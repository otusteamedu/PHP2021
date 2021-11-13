<?php

namespace App;


class App
{
    private $app;

    public function run($appType)
    {
        set_time_limit(0);
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