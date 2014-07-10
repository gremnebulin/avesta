<?php

/*This application will need some configuration.

Only the file app/config.php need be altered.

1. The following directives will need to be set:-

	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASSWORD', '23skidoo');
	define('DBNAME', 'srtest');

2. The application assumes an address of localhost/studentroom. If this
is not the case, the following functions will need to be amended.

	function subdomain()
	{
		return 'studentroom';
	}

	function base_url()
	{
		$subdomain = subdomain();
		return 'http://localhost/'.$subdomain.'/';
	}
*/

error_reporting(E_ALL | E_STRICT);

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASSWORD', '23skidoo');
define('DBNAME', 'avesta');

function subdomain()
{
	return 'avesta';
}

function base_url()
{
	$subdomain = subdomain();
	return 'http://localhost/'.$subdomain.'/';
}

$tables = array('TestData'); 
?>
