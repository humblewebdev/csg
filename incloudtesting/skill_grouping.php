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

$desc = '/^FAST/';
$desc2 = '/Chat/';
$desc3 = '/FAST: Outbound/';
$desc4 = '/OB/';
$desc5 = '/Test/';
$desc6 = '/InActive/';
$flag = 0;
$groupone = array();
$grouptwo = array();
$groupthr = array();
$groupfor = array();
$i = 1;
/* Creates array of available #'s */
foreach ( $list as $skl ){
	if ( !preg_match($desc6, ($skl->Status)) && preg_match($desc, ($skl->SkillName)) && !preg_match($desc3, ($skl->SkillName)) && !preg_match($desc4, ($skl->SkillName)) && !preg_match($desc5, ($skl->SkillName)) && !preg_match($desc2, ($skl->SkillName)) ){
		//echo $i." ".$skl->SkillName." ".$skl->Status."<br>";
		if ( $i == 1 ){
		$groupone[] = $skl->SkillNo;
		$i++;
		continue;
		}
		if ( $i == 2 ){
		$grouptwo[] = $skl->SkillNo;
		$i++;
		continue;
		}
		if ( $i == 3 ){
		$groupthr[] = $skl->SkillNo;
		$i++;
		continue;
		}
		if ( $i == 4 ){
		$groupfor[] = $skl->SkillNo;
		$i = $i - 3;
		continue;
		}
	}
}

var_dump($groupone);
echo "<br><br>";
var_dump($grouptwo);
echo "<br><br>";
var_dump($groupthr);
echo "<br><br>";
var_dump($groupfor);

$parameters = array('applicationId' => $appID, 'agentNo' => 223344);
$agentcall = array($client->AgentSkill_GetList($parameters));
$agentlist = $agentcall[0]->AgentSkill_GetListResult->inAgentSkill;

foreach ( $agentlist as $item ){
	echo $item->SkillNo."<br>";
}
?>