<?php

class SessionBase extends Base
{
	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION)) {
			session_start();		
		}
	}
	public function destroy()
	{
		session_destroy();
	}

}
?>
