<?php

	/*Front-end controller. This 
	1. Handles routing of messages.
	2. Calls in classes and instantiates objects to despatch messages
	*/

class Controller extends ControllerBase
{
	function __construct($tables, $route=array())
	{
		parent::__construct($tables, $route);
	}
	
	public function view($view='home', $table='', $id=null)
	{
		//Default action, mainly for viewing home.
		debug_message("controller->view($view,$table,$id)");
		$data = array();
		$view = new View($view, $data);
	}

	public function fetch($view=null, $table='', $id=null)
	{
		debug_message("controller->fetch($view,$table,$id)");
		if (!$id) { 
			$item_list = $this->model->fetch_list($table);
			$data['item_list'] = $item_list;
			$view = new View($view, $data);
		} else {
			$row = $this->model->fetch_detail($table, $id);
			$data['row'] = $row;
			$view = new View($view, $data);
		}
	}


	public function update($view=null, $table='', $id=null)
	{
		debug_message("controller->update($view,$table,$id)");
		if (!$id) { 
			$item_list = $this->model->store($table);
			$data['item_list'] = $item_list;
			$view = new View($view, $data);
		} else {
			$row = $this->model->store($table, $id);
			$data['row'] = $row;
			$view = new View($view, $data);
		}
	}

	public function restart($view='home', $table='', $id=null)
	{
		debug_message("controller->restart($view,$table,$id)");
		parent::restart();
		$view = new View($view);
	}

	public function __call($name, $args)
	{
		debug_message("controller->_call($name)");
		$argstring = implode(',', $args);
		echo "<h1>Request $name/$argstring not understood</h1>";
	}

}
?>
