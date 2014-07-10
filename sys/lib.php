<?php
//Utility functions.

function debug_message($message) {
	error_log('DEBUG '.$message);
}

function error_message($message) {
	error_log('ERROR '.$message);
}

function warning_message($message) {
	error_log('WARNING '.$message);
}

function info_message($message) {
	error_log('INFO '.$message);
}

function sanitise_out($string)
{ 
	return htmlspecialchars($string);
}
?>
