<?php

include "soapconnection.php";

$firstkey = $_POST['firstname'];
$lastkey = $_POST['lastname'];

$first = "/^$firstkey$/";
$last = "/^$lastkey$/";

$call = array($client->Agent_GetActiveList($appIDrequest));
$liveagents = $call[0]->Agent_GetActiveListResult->inAgent;

foreach ( $liveagents as $agent ){
	if ( preg_match($first, ($agent->FirstName)) && preg_match($last, ($agent->LastName))){
		echo "Agent Name: ".$agent->FirstName." $agent->LastName<br>";
		echo "Agent Number: ".$agent->AgentNo."<br>";
		echo "Agent Username: ".$agent->UserName."<br>";
		echo "Agent Team: ".$agent->TeamName."<br>";
	}
}
		

?>