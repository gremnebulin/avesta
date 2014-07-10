<?php

//Note that this class will attempt to create and populate

// tables based on local .sql files.

class Model extends ModelBase
{
	function __construct($db=array(), $tables=array()) 
	{
		parent::__construct($db, $tables);
	}
	
	public function fetch_list($table)
	{
		debug_message("model fetch_list()");
		$list = array();
		$sql = "SELECT * FROM $table;";
		$res = mysqli_query($this->con, $sql);	
		if (!$res) {
			error_message(mysqli_error($this->con));
		} else {
		
			while ($row = mysqli_fetch_assoc($res)){
				$list []= $row;
			}
			debug_message("model->fetch() got ".count($list));
			//debug_message("model->fetch() got ".print_r($list));
		}
		return $list;
	}

	public function fetch_detail($table, $id)
	{
		debug_message("model fetch_detail($id)");
		$id = $this->sanitise1($id);
		if (!$table) $table = $this->table;
		$sql = "SELECT * FROM $table WHERE id=$id;";
		$res = mysqli_query($this->con, $sql);	
		if (!$res) {
			error_message(mysqli_error($this->con));
		} else {
			$row = mysqli_fetch_assoc($res);
		}
		return $row;
	}

	public function fetch_detail_list($table, $id_list) 
	{
		$detail_list = array();
		foreach ($id_list as $id) {
			$row = $this->fetch_detail($table, $id);
			$detail_list []= $row;
		}
		return $detail_list;
	}

	public function store($table,$id=0,$data=array())
	{
		debug_message("Model store($table, ".count($data).")");
		$error_message = '';
		if (!$table) $table = $this->table;

		if (!$id) {
			$keys = implode(',', array_keys($data));

			$sanitised= $this->sanitise($data);
			$values = implode(',', $sanitised);

			$sql = "INSERT INTO $table($keys) VALUES($values)";
		} else {
			$id = (int)$id;
			$set_list = '';
			foreach($data as $key=>$val) {
				if (!$set) $set .= ', ';
				$set_list.= "$key=".$this->sanitise($val);
			}
			$sql = "UPDATE $table ";
			$sql.= "SET  $set_list";
			$sql.= "WHERE id=$id ";
		}

		$res = mysqli_query($this->con, $sql);	
		if (!$res) {
			$error_message = mysqli_error($this->con);
			error_message($error_message);
		}


		return $error_message;
	}

}
?>
