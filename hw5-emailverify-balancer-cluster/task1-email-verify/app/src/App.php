<?php

namespace App;

use Repetitor202\Email\IEmailReport;
use Repetitor202\Email\ReportFactory;
use Repetitor202\FileParser;


class App
{
    private IEmailReport $emailReport;

    public function run(): void
    {
        $emails = (new FileParser())->getLines($_SERVER['argv'][1]);


        $this->emailReport = new ReportFactory();

        $this->emailReport->setValidateEmail();
        $this->emailReport->setValidateHostname();

        $this->emailReport->validateList($emails);
    }
}