<?php

namespace Chat;

class Application
{
    private $application;
    private $config;

    public function run($type)
    {
        set_time_limit(0);
        ob_implicit_flush();

        $this->getConfig();
        switch ($type) {
            case 'server':
                $this->application = new ApplicationServer($this->config);

                break;
            case 'client':
                $this->application = new ApplicationClient($this->config);

                break;
            default:
                break;
        }
        $this->application->run();
    }

    private function getConfig()
    {
        $this->config = parse_ini_file('config/application.ini');
    }
}
