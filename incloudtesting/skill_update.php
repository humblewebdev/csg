<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		get_agents.php												           */
/* Author:		Eric Ruiz															   */
/* Company:		CSG																	   */
/* Date:		January 2013														   */							
/* Usage:		Updates all FAST Skills												   */
/*-------------------------------------------------------------------------------------*/

include "soapconnection.php";
include "dbc.php";

date_default_timezone_set('America/Chicago');
$dt = new DateTime('now');
$fdt = $dt->format('Y-m-d\TH:i:sP');

$call = array($client->Skill_GetList($appIDrequest));
$list = $call[0]->Skill_GetListResult->inSkill;

$desc = '/^21stOB_[0-9]*$/';
$desc2 = '/^FAST/';
$desc3 = '/FAST: Outbound/';
$desc4 = '/OB/';
$desc5 = '/Dialer/';
$flag = 0;
$skill_list = array();

/* Creates array of available #'s */
foreach ( $list as $skl ){
	if ( preg_match($desc, ($skl->SkillName)) ){
		//echo $skl->SkillName;// . " " . $skl->CustomScriptName . "<br>";
		$skill_list[] = $skl->SkillNo;
	}
}

/*
foreach ( $skill_list as $skill ){
echo $skill."<br>";
}
//var_dump($skill_list);
$i = 0;
*/
foreach ( $skill_list as $skl ){
	
	$params = array('applicationId' => $appID, 'skillNo' => $skl);
	$findSkill = array($client->Skill_Find($params));
	$skillObject = $findSkill[0]->Skill_FindResult;
	echo "$skillObject->SkillName<br>";
	
	$skillObject->CustomScriptID = 3396839;
	$skillObject->CustomScriptName = "21stCentury_TrainingOB";
	
	$parameters = array('applicationId' => $appID, 'skill' => $skillObject);
	$updateSkill = array($client->Skill_Update($parameters));
	
}

?>