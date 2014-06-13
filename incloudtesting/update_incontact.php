<?php

include "soapconnection.php";

date_default_timezone_set('America/Chicago');
$dt = new DateTime('now');
$fdt = $dt->format('Y-m-d\TH:i:sP');

$call = array($client->Agent_GetActiveList($appIDrequest));
$result = $call[0]->Agent_GetActiveListResult->inAgent;

$team_list = array();

$key = '/^Farmers - Stuart$/';
$exc_one = '/^Shanika$/';
$exc_two = '/^Rudolpho$/';
$exc_thr = '/^Anjanae$/';

foreach ( $result as $rep ){
	$name = $rep->FirstName." ".$rep->LastName;
	$team = $rep->TeamName;
	if ( preg_match($key, $team) && !(preg_match($exc_one, $rep->FirstName) || preg_match($exc_two, $rep->FirstName) || preg_match($exc_thr, $rep->FirstName))  )
	$team_list[] = $rep;
	}
	
foreach ( $team_list as $rep ){
	echo "$rep->FirstName $rep->LastName<br>";
	$parameters = array('applicationId' => $appID, 'agentNo' => $rep->AgentNo);
	$skillcall = array($client->AgentSkill_GetList($parameters));
	
	$skillresult = $skillcall[0]->AgentSkill_GetListResult;
	
	foreach ($skillresult as $skill){
		foreach ($skill as $item){
			var_dump($item);
			echo "<br>";
		}
		echo "<br><br>";
	}
	
}

/*	
foreach ( $team_list as $rep ){
	echo "$rep->FirstName $rep->LastName<br>";
	$agent1 = new agentSkill();
	$agent1->SkillNo = '153870';
	$agent1->AgentNo = $rep->AgentNo;
	$agent1->Proficiency = 'Medium';
	$agent1->LastModified = $fdt;
	$parameters1 = array('applicationId' => $appID, 'agentSkill' => $agent1);
	$OBcall = array($client->AgentSkill_Add($parameters1));
	
	$agent2 = new agentSkill();
	$agent2->SkillNo = '137400';
	$agent2->AgentNo = $rep->AgentNo;
	$agent2->Proficiency = 'Medium';
	$agent2->LastModified = $fdt;
	$parameters2 = array('applicationId' => $appID, 'agentSkill' => $agent2);
	$vercall = array($client->AgentSkill_Add($parameters2));
	
	$agent3 = new agentSkill();
	$agent3->SkillNo = '148102';
	$agent3->AgentNo = $rep->AgentNo;
	$agent3->Proficiency = 'Medium';
	$agent3->LastModified = $fdt;
	$parameters3 = array('applicationId' => $appID, 'agentSkill' => $agent3);
	$CCcall = array($client->AgentSkill_Add($parameters3));
	
	$agent4 = new agentSkill();
	$agent4->SkillNo = '153869';
	$agent4->AgentNo = $rep->AgentNo;
	$agent4->Proficiency = 'Medium';
	$agent4->LastModified = $fdt;
	$parameters4 = array('applicationId' => $appID, 'agentSkill' => $agent4);
	$liencall = array($client->AgentSkill_Add($parameters4));
	
	$agent5 = new agentSkill();
	$agent5->SkillNo = '131663';
	$agent5->AgentNo = $rep->AgentNo;
	$agent5->Proficiency = 'Medium';
	$agent5->LastModified = $fdt;
	$parameters5 = array('applicationId' => $appID, 'agentSkill' => $agent5);
	$call5 = array($client->AgentSkill_Add($parameters5));
	
	$agent6 = new agentSkill();
	$agent6->SkillNo = '153766';
	$agent6->AgentNo = $rep->AgentNo;
	$agent6->Proficiency = 'Medium';
	$agent6->LastModified = $fdt;
	$parameters6 = array('applicationId' => $appID, 'agentSkill' => $agent6);
	$call6 = array($client->AgentSkill_Add($parameters6));
	
	$agent7 = new agentSkill();
	$agent7->SkillNo = '148654';
	$agent7->AgentNo = $rep->AgentNo;
	$agent7->Proficiency = 'Medium';
	$agent7->LastModified = $fdt;
	$parameters7 = array('applicationId' => $appID, 'agentSkill' => $agent7);
	$call7 = array($client->AgentSkill_Add($parameters7));
	
	$agent8 = new agentSkill();
	$agent8->SkillNo = '131662';
	$agent8->AgentNo = $rep->AgentNo;
	$agent8->Proficiency = 'Medium';
	$agent8->LastModified = $fdt;
	$parameters8 = array('applicationId' => $appID, 'agentSkill' => $agent8);
	$call8 = array($client->AgentSkill_Add($parameters8));
}
*/

	
?> 