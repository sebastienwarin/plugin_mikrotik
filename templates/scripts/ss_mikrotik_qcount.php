<?php

$no_http_headers = true;

/* display no errors */
error_reporting(0);

if (!isset($called_by_script_server)) {
	include(dirname(__FILE__) . "/../include/global.php");
	array_shift($_SERVER["argv"]);
	print call_user_func_array("ss_mikrotik_qcount", $_SERVER["argv"]);
}

function ss_mikrotik_qcount($hostid = "") {
	$queues = db_fetch_cell("SELECT count(*)
		FROM plugin_mikrotik_queues
		WHERE host_id=$hostid 
		AND unix_timestamp(last_seen)>unix_timestamp()-1200");

	if ($queues == '') $queues = 'U';

	return $queues;
}

?>
