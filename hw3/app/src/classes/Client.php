<?php
declare(strict_types=1);

namespace APP;

class Client
{
	public function processing(array $config)
	{
		$this->workSocket($config);
	}

	private function workSocket(array $config)
	{
		$fileServer = $config['fileServer'];
		$fileClient = $config['fileClient'];
		$stopWord = $config['stopWord'];
		$stopPhrase = $config['stopPhrase'];

		$output = new Output();
		$output->setOutput();

		$open = new Open();
		$socketRead = $open->openSockets($fileClient);

		echo 'Client started'.PHP_EOL.'Stop server - enter "'.$stopWord.'"'.PHP_EOL;

		do {
			echo 'Enter command: ';
			$message = fgets(STDIN, 255);

			$write = new Write();
			$write->writeMessage($fileServer, $message);

			$read = new Read();
			$message = $read->readMessage($socketRead);
		
			echo 'Server sent message: '.$message.PHP_EOL;
			
			if ($message === $stopPhrase.PHP_EOL) {
				echo 'Client will be stopped'.PHP_EOL;
			}
		} while ($message !== $stopPhrase.PHP_EOL);

		$close = new Close();
		$close->closeSocket($socketRead, $fileClient);

		echo 'Client stopped. By by!'.PHP_EOL;
	}
}