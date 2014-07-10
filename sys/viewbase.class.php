<?php

// Includes the v####.php files.
class ViewBase  extends Base
{
	function __construct($view, $data=array())
	{
		parent::__construct();
		$this->render($view, $data);
	}

	public function render($view, $data=array())
	{
		debug_message("render($view,".count($data).")");
		global $config;
		$_base_url = $config->base_url();
		extract($data);
		require('app/v'.$view.'.php');	
	}
}

?>

