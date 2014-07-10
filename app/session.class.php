<?php

class Session extends SessionBase
{
	function __construct()
	{
		parent::__construct();
	}

	public function  add_viewed($id)
	{
		#Add $id to comma separated list stored in session
		$viewed = $this->read_viewed();
		if (!in_array($id, $viewed)) {
			$viewed []= $id;
			$_SESSION['viewedlist'] = implode(',', $viewed);
		}
	}

	 public function  remove_viewed($id)
	{	
		
		$viewed = @$_SESSION['viewedlist'];
		$viewed = str_replace("$id,", "", $viewed);
		debug_message("session remove_viewed($id) after=$viewed");
		$_SESSION['viewedlist'] = $viewed;
	}

	public function read_viewed()
	{
		$viewed_list = explode(',', @$_SESSION['viewedlist']);
		$viewed_list = array_filter($viewed_list);//remove blanks
		return $viewed_list;
	}

}
?>
