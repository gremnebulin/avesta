<?php

class Config extends ConfigBase
{
	private $dbconnect = array(
	    'host' => 'localhost',
	    'user' => 'root',
	    'password' => '23skidoo',
	    'dbname' => 'avesta'
	);
	private $tables = array('TestData'); 

	private $locations = array('subdomain'=>'avesta'); 

	private $options = array(
	);

	public function dbconnect() 
	{
		return $this->dbconnect;
	}

	public function tables() 
	{
		return $this->tables;
	}

	public function option($name) 
	{
		return $this->options[$name];
	}

	public function locations()
	{
		return $this->locations;
	}

	public function base_url()
	{
		$subdomain = $this->locations['subdomain'];
		return 'http://localhost/'.$subdomain.'/';
	}
        //public function __get($name)
        //{
            ////echo "Getting '$name'\n";
            //if (array_key_exists($name, $this->data)) {
                //return $this->data[$name];
	   //} else {
		//error_message("Config: could not find $name");
           //}
        //}
}
?>
