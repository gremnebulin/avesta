<?php

	/*Front-end controller. This 
	1. Handles routing of messages.
	2. Calls in classes and instantiates objects to despatch messages
	*/

class Router extends RouterBase
{
	function __construct($locations, $request_uri='')
	{
		parent::__construct($locations, $request_uri);
	}
}
?>
