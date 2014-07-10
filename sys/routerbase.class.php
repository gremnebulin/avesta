<?php

	/*Front-end controller. This 
	1. Handles routing of messages.
	2. Calls in classes and instantiates objects to despatch messages
	*/

class RouterBase extends Base
{
	protected $locations = False;

	protected $action = False;
	protected $view = False;
	protected $table = False;
	protected $id = False;

	function __construct($locations, $request_uri='')
	{
		parent::__construct();
		$this->locations = $locations;
		if ($request_uri) {
			$this->break_up_message($request_uri);	
		}
	}

	public function get_route()
	{
		debug_message("router->get_route() action=$this->action, view=$this->view, table=$this->table id=$this->id");
		$route = array($this->action, $this->view, $this->table, $this->id);
		return $route;                                          
	}

	public function break_up_message($request_uri)
	{
		//Initialisation over. Routing starts. 
		//...Break up request in order to route it.
		//$request_uri = $_SERVER['REQUEST_URI'];
		$subdomain = $this->locations['subdomain'];
		debug_message("request_uri=$request_uri subdomain=$subdomain");
		$request_uri = str_replace('/'.$subdomain, '', $request_uri);
		debug_message("request_uri=$request_uri ");
		$request_uri = str_replace('/index.php', '', $request_uri);
		debug_message("request_uri=$request_uri ");
		$request_uri = preg_replace('/^\/*/', '', $request_uri);
		debug_message("request_uri=$request_uri ");
		$request_parts = explode('/', $request_uri);
		$this->action = @$request_parts[0];
		$this->view = @$request_parts[1];
		$this->table = @$request_parts[2];
		$this->id = @$request_parts[3];

		debug_message("request_uri=$request_uri action=$this->action view=$this->view table=$this->table id=$this->id");

		//..Begin despatching.
		//.....first some defaults.
		if (!$this->action) { #Default action.
			$this->action = 'view';
		}
		if (!$this->view) {
			#Default action.
			$this->view = 'home';
		}
		return array($this->action, $this->view, $this->table, $this->id);
	}
}
?>
