<?php

//Note that this class will attempt to create and populate

// tables based on local .sql files.

class Model extends ModelBase
{
	function __construct($db=array(), $tables=array()) 
	{
		parent::__construct($db, $tables);
	}
	
	public function read_list($table)
	{
		debug_message("model read_list()");
		$list = array();
		$sql = "SELECT * FROM $table;";
		$res = mysqli_query($this->con, $sql);	
		if (!$res) {
			error_message(mysqli_error($this->con));
		} else {
		
			while ($row = mysqli_fetch_assoc($res)){
				$list []= $row;
			}
			debug_message("model->read()) got ".count($list));
			//debug_message("model->fetch() got ".print_r($list));
		}
		return $list;
	}

	public function read_detail($table, $id)
	{
		debug_message("model read_detail($id)");
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

	public function read_detail_list($table, $id_list) 
	{
		$detail_list = array();
		foreach ($id_list as $id) {
			$row = $this->read_detail($table, $id);
			$detail_list []= $row;
		}
		return $detail_list;
	}

	public function create($table,$data=array())
	{
		debug_message("Model store($table, ".count($data).")");
		$error_message = '';
		if (!$table) $table = $this->table;

		$keys = implode(',', array_keys($data));

		$sanitised= $this->sanitise($data);
		$values = implode(',', $sanitised);

		$sql = "INSERT INTO $table($keys) VALUES($values)";

		$res = mysqli_query($this->con, $sql);	
		if (!$res) {
			$error_message = mysqli_error($this->con);
			error_message($error_message);
		}
		return mysqli_affected_rows();
	}

	public function update($table, $id, $data=array())
	{
		$id = (int)$id;
		$set_list = '';
		foreach($data as $key=>$val) {
			if (!$set) $set .= ', ';
			$set_list.= "$key=".$this->sanitise($val);
		}
		$sql = "UPDATE $table ";
		$sql.= "SET  $set_list";
		$sql.= "WHERE id=$id ";

		$res = mysqli_query($this->con, $sql);	
		if (!$res) {
			$error_message = mysqli_error($this->con);
			error_message($error_message);
		}


		return mysqli_affected_rows();
	}

	public function delete($table, $id, $data=array())
	{
		$id = (int)$id;
		$set_list = '';
		foreach($data as $key=>$val) {
			if (!$set) $set .= ', ';
			$set_list.= "$key=".$this->sanitise($val);
		}
		$sql = "DETELE FROM $table ";
		$sql.= "WHERE id=$id ";

		$res = mysqli_query($this->con, $sql);	
		if (!$res) {
			$error_message = mysqli_error($this->con);
			error_message($error_message);
		}


		return mysqli_affected_rows();
	}

}
?>
