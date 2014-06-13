<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		get_agents.php												           */
/* Author:		Eric Ruiz															   */
/* Company:		CSG																	   */
/* Date:		January 2013														   */							
/* Usage:		assigns skill to initial 20 agents in campaign						   */
/*-------------------------------------------------------------------------------------*/

include "soapconnection.php";
include "dbc.php";

date_default_timezone_set('America/Chicago');
$dt = new DateTime('now');
$fdt = $dt->format('Y-m-d\TH:i:sP');

$call = array($client->Agent_GetList($appIDrequest));
$list = $call[0]->Agent_GetListResult->inAgent;

$desc = '/^21st$/';
$flag = 0;
$agent_list = array();

/* Creates array of available #'s */
foreach ( $list as $agent ){
	if ( preg_match($desc, ($agent->FirstName)) ){
		echo $agent->FirstName . " " . $agent->LastName . " " . $agent->TeamName . "<br>";
		$agent_list[] = $agent->AgentNo;
	}
}


foreach ( $agent_list as $agentNo ){
	$newAS = new agentSkill();
	$newAS->SkillNo = 224370;
	$newAS->AgentNo = $agentNo;
	$newAS->Proficiency = 'High';
	$newAS->LastModified = $fdt;
	
	$parameters = array('applicationId' => $appID, 'agentSkill' => $newAS);
	$addAgent = array($client->AgentSkill_Add($parameters));
}

?>