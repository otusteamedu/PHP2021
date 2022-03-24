<?php
declare(strict_types=1);

namespace APP;

class Server
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
		$socketRead = $open->openSockets($fileServer);

		echo 'Server started'.PHP_EOL;
		
		do {
			$read = new Read();
			$message = $read->readMessage($socketRead);
			
			echo 'Client sent message: '.$message;

			$lenght = strlen($message) - 1;
			$messWrite = 'Received '.$lenght.' chars';
			
			if ($message === $stopWord.PHP_EOL) {
				$messWrite = $stopPhrase.PHP_EOL;
				echo $stopPhrase.PHP_EOL;
			}

			$write = new Write();
			$write->writeMessage($fileClient, $messWrite);
		} while ($message !== $stopWord.PHP_EOL);

		$close = new Close();
		$close->closeSocket($socketRead, $fileServer);

		echo 'Server stopped. By by!'.PHP_EOL;
	}
}