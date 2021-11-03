<?php

namespace HW4;

use Exception;

Class App 
{

	public function run() : void
	{
		if ( empty( $_POST['string'] ) )
		{
			http_response_code(400);
			throw new Exception( 'Empty string' );
		}
		
		$string = $_POST['string'];

		if ( $this->checkString( $string ) ) 
		{
			http_response_code(200);
			echo 'OK';
		} 
		else 
		{
			http_response_code(400);
			throw new Exception( 'Wrong brackets count' );
		}
	}
	
	private function checkString( string $string ) : bool
	{
		$balance = 0;
		
		for ( $i = 0; $i < strlen( $string ); $i++ )
		{
			if ( $string[ $i ] === '(' )
			{
				$balance++;
			}
			elseif ( $string[ $i ] === ')' )
			{
				$balance--;
			}
			
			if ( $balance < 0 )
			{
				return false;
			}
		}
		
		if ( $balance !== 0 )
		{
			return false;
		}
		
		return true;
	}

}

