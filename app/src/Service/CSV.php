<?php

namespace Src\Service;

class CSV
{
    private const PATH = '/include/emails.csv';

    /**
     * @return array
     */
    public function getEmails(): array
    {
        return $this->getData() ?: [];
    }

    private function getFile()
    {
        return fopen($_SERVER['DOCUMENT_ROOT'].self::PATH,'r');
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        $file = $this->getFile();
        fgetcsv($file, 0, ',');

        $emails = [];
        while (($row = fgetcsv($file, 0, ',')) !== false) {
            $emails = array_merge($emails,$row);
        }
        return $emails ?: [];
    }
}