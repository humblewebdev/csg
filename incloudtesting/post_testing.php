<?php

include "soapconnection.php";

date_default_timezone_set('America/Chicago');
$dt = new DateTime('now');
$fdt = $dt->format('Y-m-d\TH:i:sP');

$newSkill = new skill();
$newSkill->SkillNo = 173386;
$newSkill->SkillName = "inCloud Test";	// custom
$newSkill->MediaType = 'PhoneCall';
$newSkill->Status = 'Active';
$newSkill->CampaignNo = 67317;
$newSkill->OutboundSkill = false;
$newSkill->SLASeconds = 30;
$newSkill->SLAPercent = 90;
$newSkill->Notes = 'n/a';
$newSkill->Description = 'This is the first skill_add call using inCloud APIs with custom code';
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
$newSkill->CustomScreenPopApp = 'http://www.google.com';	// custom
$newSkill->CampaignName = '';
$newSkill->LastModified = $fdt;
$newSkill->ShortAbandonThreshold = 15;
$newSkill->UseShortAbandonThreshold = false;
$newSkill->IncludeShortAbandons = true;
$newSkill->IncludeOtherAbandons = true;
$newSkill->CustomScriptID = 0;
$newSkill->CustomScriptName = '';
$newSkill->IsDialer = false;
$newSkill->EnableBlending = false;

//var_dump($newSkill);

try {

$parameters = array('applicationId' => $appID, 'skill' => $newSkill);

$skilladd = array($client->Skill_Update($parameters));

} catch (Exception $e){
	echo 'Caught Exception <b>' , $e->getMessage(), '</b><br>';
}

var_dump($skilladd);

?>