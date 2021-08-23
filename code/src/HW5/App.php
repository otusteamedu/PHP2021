<?php

namespace HW5;

use Exception;


Class App 
{
	private $emails = [];
	
	public function __construct( array $emails )
	{
		$this->emails = $emails;
	}
	
	public function run( ) : void
	{
		if ( empty( $this->emails ) )
		{
			throw new Exception( 'No emails' );
		}
		
		foreach ( $this->emails as $email )
		{
			echo $email . ' = ' . ( ( $this->checkEmail( $email) ) ? 'valid' : 'invalid' ) . "\r\n\r\n";
		}
		
		
	}
	
	private function checkEmail( string $email ) : bool
	{
		if ( empty( $email ) )
		{
			return false;
		}
		
		if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) 
		{
			return false;
		}
		
		$host = explode('@', $email)[1];
		
		$getmxrr = getmxrr( $host, $mx_records);
		
		if ( !$getmxrr )
		{
			return false;
		}
		
		return true;
	}
	
	

}

