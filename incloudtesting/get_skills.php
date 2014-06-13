<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		get_poc.php													           */
/* Author:		Eric Ruiz															   */
/* Company:		CSG																	   */
/* Date:		January 2013														   */							
/* Usage:		returns list of all skills											   */
/*-------------------------------------------------------------------------------------*/

include "soapconnection.php";
include "dbc.php";

$call = array($client->Skill_GetList($appIDrequest));
$skills = $call[0]->Skill_GetListResult->inSkill;

//var_dump($poc);
$status = '/^Active$/';
$label = '/^FAST.*/';
$out = '/Outbound/';
$chat = '/(FAST_Chat)|(FAST Spanish)/';
$flag = 0;
$tskills = array();

/* Creates array of available #'s */
foreach ( $skills as $skill ){
	if ( (preg_match($status, ($skill->Status))) && (preg_match($label, ($skill->SkillName))) && !(preg_match($out, ($skill->SkillName))) && !(preg_match($chat, ($skill->SkillName))) ){
		$tskills[] = $skill->SkillName;
		echo "$skill->SkillName"."<br>";
	}
}

var_dump($tskills);
?>