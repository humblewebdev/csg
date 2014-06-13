<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		get_agents.php												           */
/* Author:		Eric Ruiz															   */
/* Company:		CSG																	   */
/* Date:		January 2013														   */							
/* Usage:		Updates FAST POCs to use FAST Script								   */
/*-------------------------------------------------------------------------------------*/

include "soapconnection.php";
include "dbc.php";

date_default_timezone_set('America/Chicago');
$dt = new DateTime('now');
$fdt = $dt->format('Y-m-d\TH:i:sP');

$call = array($client->PointOfContact_GetList($appIDrequest));
$list = $call[0]->PointOfContact_GetListResult->inPointOfContact;

//var_dump($poc);
//$desc = '/^8553100761/';
$flag = 0;
$poc_list = array();
$keys = array('/^8553946749/',
);

while ( $desc = array_shift($keys) ){
	foreach ( $list as $poc ){
		if ( preg_match($desc, ($poc->PhoneNumber)) ){
			//echo $poc->ContactDescription . " " . $poc->ScriptName . "<br>";
			$poc_list[] = $poc->ContactCode;
		}
	}
}
var_dump($poc_list);


foreach ( $poc_list as $contactCode ){
	
	$params = array('applicationId' => $appID, 'contactCode' => $contactCode);
	$findPoc = array($client->PointOfContact_Find($params));
	$pocObject = $findPoc[0]->PointOfContact_FindResult;
	
	$pocObject->ScriptName = 'Not_in_use';
	
	
	$parameters = array('applicationId' => $appID, 'pointOfContact' => $pocObject);
	$updatePoc = array($client->PointOfContact_Update($parameters));
	echo "$pocObject->ContactDescription<br>"."$pocObject->ScriptName<br><br>";
}

?>