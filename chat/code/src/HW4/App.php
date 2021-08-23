<?php

namespace HW4;

use Exception;
use HW4\Otus\Client;
use HW4\Otus\Server;


Class App 
{
	public function run( array $argv ) : void
	{
		if ( empty($argv) )
		{
			throw new Exception( 'Missing app type. Use "php app.php client" or "php app.php server" ' );
		}
		
		$type = $argv[1];
		
		switch ( $type )
		{
			case 'client':
				$CLIENT_SOCKET = getenv('CLIENT_SOCKET', true) ?: getenv('CLIENT_SOCKET');
				$CLIENT_PORT = getenv('CLIENT_PORT', true) ?: getenv('CLIENT_PORT');
				$client = new Client( $CLIENT_SOCKET , $CLIENT_PORT);
				$client->waitForMessage();
				break;
				
			case 'server':
				$SERVER_SOCKET = getenv('SERVER_SOCKET', true) ?: getenv('SERVER_SOCKET');
				$SERVER_PORT = getenv('SERVER_PORT', true) ?: getenv('SERVER_PORT');
				$server = new Server( $SERVER_SOCKET, $SERVER_PORT );
				$server->listen();
				break;
			
			default:
				throw new Exception( 'Wrong app type.' );
				break;
		}
	}
	
	

}

