
<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		soapconnection.php													   */
/* Author:		Eric Ruiz & Zachary Rodriguez										   */
/* Company:		CSG																	   */
/* Date:		January 2013														   */							
/* Usage:		establishes connection to inCloud, creates reusable classes/variables  */
/*-------------------------------------------------------------------------------------*/


 /* Official DateTime Do NOT Remove */					/*----------------------------------------------------------------------*/
date_default_timezone_set('America/Chicago');			/* $fdt meets SOAP DateTime Format Requirement 							*/
$dt = new DateTime('now');								/* and may be called from any script that includes 						*/
$fdt = $dt->format('Y-m-d\TH:i:sP');					/* soapconnection.php so theres no need to create a new DateTime object */
														/*----------------------------------------------------------------------*/
													
/* Set Header Variables */
$username = "CultureServiceGrowth";
$password = "CSGPass!";
$appID = 'b0643d47-3c20-4c95-969f-caab2841f9fa';
$testappid = '59f2612a-1386-4f96-af4c-5748d904fbfc';
$url = 'https://incloudws.incontact.com/inCloudWS.asmx?WSDL';
$xmlns = 'inCloudService';
$options = array(  'soap_version' => SOAP_1_2, 'connection_timeout' => 500, 'trace' => true, 'style' => SOAP_RPC, 'use' => SOAP_ENCODED, 'Username' => $username, 'Password' => $password);

/* Create new SOAP client */
$client = new SOAPClient($url,$options);

/* Create new SOAP header */
$headerbody = array('Username' => $username, 'Password' => $password);
$header = new SOAPHeader($xmlns, 'AuthenticationHeader', $headerbody, false);
$client->__setSOAPHeaders($header);
$appIDrequest = array('applicationId' => $appID);

/* Test Client Methods Uncomment to Test */
// $testconn = array($client->TestConnection());									/*---------------------------------------------------------------------------------------------------*/
// $testauth = array($client->TestAuthenticationConnection());						/* Test Methods return boolean values, TestConnection() tests for inCloud connectivity no credentials*/
// $testid = array($client->TestApplicationConnection($appIDrequest));				/* TestAuth..() verifies credentials along with inCloud connectivity, and TestApp..() verifies       */
// var_dump($testconn);																/* inCloud connectivity along with AppID Verification												 */
// var_dump($testauth);																/*---------------------------------------------------------------------------------------------------*/
// var_dump($testid);
//var_dump($testget);


/* Pre Built Classes */
/*Classes Below [ skill, poc, campaign, agent, agentSkill ]*/
class skill{
	public $SkillNo;
	public $SkillName;
	public $MediaType;
	public $Status;
	public $CampaignNo;
	public $OutboundSkill;
	public $SLASeconds;
	public $SLAPercent;
	public $Notes;
	public $Description;
	public $Interruptible;
	public $FromEmailEditable;
	public $FromEmailAddress;
	public $UseDispositions;
	public $RequireDispositions;
	public $DispositionTimer;
	public $QueueInitPriority;
	public $QueueAcceleration;
	public $QueueFunction;
	public $QueueMaxPriority;
	public $ActiveMinWorkTime;
	public $OverrideCallerID;
	public $CallerIDNumber;
	public $UseScreenPops;
	public $UseCustomScreenPops;
	public $CustomScreenPopApp;
	public $CampaignName;
	public $LastModified;
	public $ShortAbandonThreshold;
	public $UseShortAbandonThreshold;
	public $IncludeShortAbandons;
	public $IncludeOtherAbandons;
	public $CustomScriptID;
	public $CustomScriptName;
	public $IsDialer;
	public $EnableBlending;
}

class poc{
	public $ContactCode;
	public $ContactDescription;
	public $Status;
	public $Notes;
	public $ScriptName;
	public $DefaultSkillNo;
	public $MediaType;
	public $PhoneNumber;
	public $EmailAddress;
	public $ChatName;
	public $OutboundSkill;
	public $SLASeconds;
	public $CampaignNo;
	public $CampaignName;
	public $LastModified;
}

class campaign{
	public $CampaignNo;
	public $CampaignName;
	public $Status;
	public $Description;
	public $Notes;
	public $LastModified;
}

class agent{
	public $AgentNo;
	public $Password;
	public $TeamNo;
	public $FirstName;
	public $MiddleName;
	public $LastName;
	public $Email;
	public $Status;
	public $Notes;
	public $SecurityProfileID;
	public $TeamName;
	public $LastLogin;
	public $LastModified;
	public $CurrentState;
	public $CurrentStationId;
	public $CurrentSkillNo;
	public $CurrentSkillName;
	public $UserName;
	public $UserNameDomain;
	public $ReportTo;
	public $ReportToName;
	public $ReportToFirstName;
	public $ReportToLastName;
	public $EmailRefusalTimeout;
	public $DocumentRefusalTimeout;
	public $ChatRefusalTimeout;
	public $PhoneCallRefusalTimeout;
	public $VoiceMailRefusalTimeout;
	public $NtLoginName;
	public $CreateDate;
	public $EndDate;
	public $IsSupervisor;
}

class agentSkill{
	public $SkillNo;
	public $AgentNo;
	public $Proficiency;
	public $LastModified;
}

 // Below Code is Used to Capure Errors, Remove when Unneeded
 ini_set('display_errors', 1);
 ini_set('log_errors', 1);
 ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
 error_reporting(E_ALL);
 ini_set("soap.wsdl_cache_enabled", "0");
 // Above Code is Used to Capure Errors, Remove when Unneeded
?>
