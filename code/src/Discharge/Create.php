<?php 

namespace App\Discharge;

class Create
{

    private $data;
    private array $list;
    private $buffer;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function Create(): array
    {
        $this->data = json_decode($this->data, true);

        if (!file_exists($this->data['chatId'])) { 
            mkdir($this->data['chatId']);
        }

        $this->data['url'] = $this->data['chatId'] . '/Выписка за период с ' . $this->data['dateWith'] . ' по ' . $this->data['dateBeforee'] . ' .csv';

        // Имитация запроса в базу
        sleep(15);

        $this->list = [
            [
                'data' => $this->data['dateWith'],
                'price' => '3599 RUB',
            ],    
            [
                'data' => $this->data['dateBeforee'],
                'price' => '3610 RUB',
            ]
        ];

        $this->buffer = fopen($this->data['url'], 'w');

        fputs($this->buffer, chr(0xEF) . chr(0xBB) . chr(0xBF));

        foreach($this->list as $line) { 
            fputcsv($this->buffer, $line, ';'); 
        }

        fclose($this->buffer);

        return $this->data;
    }

}