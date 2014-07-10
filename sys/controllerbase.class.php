<?php

	/*Front-end controller. This 
	1. Handles routing of messages.
	2. Calls in classes and instantiates objects to despatch messages
	*/

class ControllerBase extends Base
{
	protected $session = False;
	protected $model = False;

	function __construct($dbconnect, $tables, $route=array())
	{
		parent::__construct();
	
		//...initialise session.
		$this->session = new Session();

		//..initialise model.
		//$db = array('host'=>DBHOST, 'user'=>DBUSER, 'password'=>DBPASSWORD, 'dbname'=>DBNAME);
		//$dbconnect = $config->dbconnect();
		$this->model = new Model($dbconnect, $tables);
		
		if ($route) {
			$this->despatch($route);
		}
	}

	protected function restart()
	{
		$this->session->destroy();
	}
}
?>
