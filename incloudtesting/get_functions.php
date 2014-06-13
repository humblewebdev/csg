<?php

function getActiveAgents(){

include "soapconnection.php";

$call = array($client->Agent_GetActiveList($appIDrequest));
$result = $call[0]->Agent_GetActiveListResult->inAgent;

$active_list = array();

foreach ( $result as $rep ){
	$name = $rep->FirstName." ".$rep->LastName;
	$active_list[] = $name;
	}
	
sort($active_list);

return $active_list;

}


	
?> 