<?php

include "soapconnection.php";
include "dbc.php";

date_default_timezone_set('America/Chicago');
$dt = new DateTime('now');
$fdt = $dt->format('Y-m-d\TH:i:sP');



/* Skill Object */
$newSkill = new skill();
$newSkill->SkillNo = 0;
$newSkill->SkillName = "FAST Agent $campName";	// custom
$newSkill->MediaType = 'PhoneCall';
$newSkill->Status = 'Active';
$newSkill->CampaignNo = $CampNo;
$newSkill->OutboundSkill = false;
$newSkill->SLASeconds = 30;
$newSkill->SLAPercent = 80;
$newSkill->Notes = "Created by fast_create.php API script $fdt";
$newSkill->Description = '';
$newSkill->Interruptible = false;
$newSkill->FromEmailEditable = false;
$newSkill->FromEmailAddress = '';
$newSkill->UseDispositions = true;	
$newSkill->RequireDispositions = true;
$newSkill->DispositionTimer = 0;
$newSkill->QueueInitPriority = 0;
$newSkill->QueueAcceleration = 1;
$newSkill->QueueFunction = 'Linear';
$newSkill->QueueMaxPriority = 1000;
$newSkill->ActiveMinWorkTime = 30;
$newSkill->OverrideCallerID = false;
$newSkill->CallerIDNumber = '';
$newSkill->UseScreenPops = true;
$newSkill->UseCustomScreenPops = true;
$newSkill->CustomScreenPopApp = "http://cultureservicegrowth.com/fast/ipages/ipage.php?un=$usr";	// custom
$newSkill->CampaignName = '';
$newSkill->LastModified = $fdt;
$newSkill->ShortAbandonThreshold = 15;
$newSkill->UseShortAbandonThreshold = true;
$newSkill->IncludeShortAbandons = false;
$newSkill->IncludeOtherAbandons = true;
$newSkill->CustomScriptID = 0;
$newSkill->CustomScriptName = '';
$newSkill->IsDialer = false;
$newSkill->EnableBlending = false;

try {

$parameters = array('applicationId' => $appID, 'skill' => $newSkill);

$skilladd = array($client->Skill_Add($parameters));
$SkillNo = $skilladd[0]->Skill_AddResult;
} catch (Exception $e){
	echo 'Caught Exception <b>' , $e->getMessage(), '</b><br>';
}


?>