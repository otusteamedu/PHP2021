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
				$client_socket = getenv('CLIENT_SOCKET', true) ?: getenv('CLIENT_SOCKET');
				$client_port = getenv('CLIENT_PORT', true) ?: getenv('CLIENT_PORT');
				$client = new Client( $client_socket , $client_port);
				$client->waitForMessage();
				break;
				
			case 'server':
				$server_socket = getenv('SERVER_SOCKET', true) ?: getenv('SERVER_SOCKET');
				$server_port = getenv('SERVER_PORT', true) ?: getenv('SERVER_PORT');
				$server = new Server( $server_socket, $server_port );
				$server->listen();
				break;
			
			default:
				throw new Exception( 'Wrong app type.' );
				break;
		}
	}
	
	

}

