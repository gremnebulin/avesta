<?php

//Note that this class will attempt to create and populate

// tables based on local .sql files.

class ModelBase extends Base
{
	protected $con=false;
	protected $dbname='';
	protected $tables = array();

	function __construct($db=array(), $tables=array()) 
	{
		parent::__construct();
		//debug_message("connecting with".$db['host'].",".$db['user'].",".$db['password'].",".$db['dbname']);
		$dbname = $this->dbname = $db['dbname'];
		$this->tables = $tables;
		if ($con = $this->connect($db['host'], $db['user'], $db['password'])) {
			$this->con = $con;
			if (!$this->is_initialised()) {
				if ($this->initialise()) {
					$this->initialised = true;
					$this->tables = $tables;
				}
			}
		} else {
			error_message("Model could not connect to DB");
		}
	}

	public function connect($dbhost, $dbuser, $dbpassword) 
	{
		$con = mysqli_connect($dbhost, $dbuser, $dbpassword);
		if (!$con) {
			error_message("model - Could not connect with $dbhost, $dbuser, $dbpassword");
		}
		//debug_message("model setting connection".print_r($this->con));
		return $con;
	}

	public function is_initialised()
	{
		$initialised = mysqli_select_db($this->con, $this->dbname);
		debug_message("model checking initialisation by selecting $this->dbname=".$initialised);
		if (!$initialised) error_message(mysqli_error($this->con));
		return $initialised;
	}
	
	protected function gulp_file($file)
	{
		$contents  = file_get_contents($file);
		if ($contents) $contents = str_replace(array("\r", "\n"), ' ', $contents);
		return $contents;
	}

	public function initialise($dbname='', $tables=array())
	{
		if (!$dbname) $dbname = $this->dbname;
		if (!$tables) $tables = $this->tables;
		$error = '';
		//Check for a create database sql.
		debug_message('model Initialising database');
		//$sql = $this->gulp_file('app/create_database.sql');
		$sql = "CREATE DATABASE $this->dbname";
		if (!$sql) {
			$error = "Could not find SQL to initialise database $dbname";
			error_message($error);
		} else {
			info_message("Running SQL to initialise database $this->dbname");
			$res = mysqli_query($this->con, $sql);	
			if (!$res) {
				$error = "Could not run SQL to initialise database $this->dbname";
				error_message($error);

			} else {
				if (!mysqli_select_db($this->con, $dbname)) {
					error_message("Model could not select $dbname after initialisation of DB");
				}
			}
		}

		foreach($tables as $table) {
			//Check for a create table sql.
			info_message("Initialising table $table");
			$sql = $this->gulp_file("app/create_$table.sql");
			if (!$sql) {
				$error .= "Could not initialise table $table";
				error_message("Could not initialise table $table");
			} else {
				$res = mysqli_query($this->con, $sql);	
				if (!$res) {
					error_message(mysqli_error($this->con));
				}
				//Check for a populate table sql.
				debug_message("Populating table $table");
				$sql = $this->gulp_file("app/populate_$table.sql");
				if (!$sql) {
					//We do not have a populater for the purchases table.
					warning_message("Could not populate table $table");
				} else {
					$res = mysqli_query($this->con, $sql);	
					if (!$res) {
						error_message(mysqli_error($this->con));
					}
				}
			}
		} //end foreach

		return $error;
	}

	protected function sanitise1($input)
	{
		$input = strip_tags($input);	
		return mysqli_real_escape_string($this->con, $input);
	}

	protected function sanitise($data)
	{
		$valarr = array_values($data);
		foreach($val_arr as $rawval) {
			$sanitised[]= $this->sanitise1($rawval);
		}
		return $sanitised;
	}
}
?>
