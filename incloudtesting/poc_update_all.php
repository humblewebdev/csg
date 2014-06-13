<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		get_agents.php												           */
/* Author:		Eric Ruiz															   */
/* Company:		CSG																	   */
/* Date:		January 2013														   */							
/* Usage:		Updates details of any/all POCs	WARNING	CHANGES ARE REAL TIME		   */
/*-------------------------------------------------------------------------------------*/

include "soapconnection.php";
include "dbc.php";

date_default_timezone_set('America/Chicago');
$dt = new DateTime('now');
$fdt = $dt->format('Y-m-d\TH:i:sP');

$call = array($client->PointOfContact_GetList($appIDrequest));
$list = $call[0]->PointOfContact_GetListResult->inPointOfContact;

//var_dump($poc);
$desc = '/^AVAILABLE [0-9]*/';
$script = '/^Not_in_use$/';
$flag = 0;
$poc_list = array();

/* Creates array of available #'s */
foreach ( $list as $poc ){
	if ( preg_match($desc, ($poc->ContactDescription)) && preg_match($script, ($poc->ScriptName)) ){
		//echo $poc->ContactDescription . " " . $poc->ContactCode . " " . $poc->ScriptName . "<br>";
		$poc_list[] = $poc->ContactCode;
	}
}

/*
foreach ( $poc_list as $poc){
	echo "$poc<br>";
	
	echo str_replace("Available", "AVAILABLE", $poc)."<br>";
}
*/



for ( $i = 1; $i < 23; $i++ ){
	
	$contactCode = array_pop($poc_list);
	echo "$contactCode\n";
	
	$params = array('applicationId' => $appID, 'contactCode' => $contactCode);
	$findPoc = array($client->PointOfContact_Find($params));
	$pocObject = $findPoc[0]->PointOfContact_FindResult;
	
	$name = $pocObject->ContactDescription;
	$pattern = '/^.*$/';
	if ( $i < 10 ){
	$newname = "21st_TF0$i";
	} else {
	$newname = "21st_TF$i";
	}
	$pocObject->ContactDescription = preg_replace($pattern, $newname, $name);
	$pocObject->ScriptName = "21stCentury_Training";
	
	echo $pocObject->ContactDescription . " " . $pocObject->PhoneNumber .  " " . $pocObject->ScriptName . "<br>";
	
	
	$parameters = array('applicationId' => $appID, 'pointOfContact' => $pocObject);
	$updatePoc = array($client->PointOfContact_Update($parameters));
	
	
}



?>