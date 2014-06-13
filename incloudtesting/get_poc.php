<?php
/*---------------------------------------------------------------------------------------------------*/
/* Name: 		get_poc.php													                         */
/* Author:		Eric Ruiz															                 */
/* Company:		CSG																	                 */
/* Date:		January 2014 ( Previous Version Jan '13)							                 */							
/* Usage:		adds 'Available' poc's in inContact that currently dont exist in db table 'poc_list' */
/*---------------------------------------------------------------------------------------------------*/

include "soapconnection.php";
include "db_connect.php";

$case = 0;
$call = array($client->PointOfContact_GetList($appIDrequest));
$poc = $call[0]->PointOfContact_GetListResult->inPointOfContact;

//var_dump($poc);
$available = '/^Available.*/i';
$local = '/^210/';

/* Creates array of available #'s in inContact*/
foreach ( $poc as $contact ){
	if ( preg_match($available, ($contact->ContactDescription))  &&  !(preg_match($local, ($contact->PhoneNumber))) ){	
		$incontact_numbers[] = $contact->PhoneNumber;
	}
}

/* if no 'Available' numbers found, notify and exit */
if(empty($incontact_numbers)){
	mail("csgit@csg-email.com", "FAST - No Available Numbers", "Warning: No Available Numbers we're found in inContact");
	exit("No available numbers returned from web service, script exit");
} else if ( count($incontact_numbers) < 5 ){
	mail("csgit@csg-email.com", "FAST - Less than 5 'Available' Numbers remaining", "Warning: Very Few Available Numbers we're found in inContact -- Order Soon");
}

/* Creates array of #'s existing in database */
$num_in_db = array();
$sql = $mysqli->query("SELECT * FROM poc_list") or die ($mysqli->error);
while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)){
	$num_in_db[] = $row['poc'];
}

if(empty($num_in_db)){ // if numbers are NOT found in db add all 'Available' incontact numbers
	$case = 12;
	echo "case 1<br>";
	foreach( $incontact_numbers as $number ){
		foreach( $poc as $contact ){
			if( $number == $contact->PhoneNumber){
				$newnums[] = array($contact->PhoneNumber, $contact->ContactCode);
			}
		}
	}
	
	/* adds to DB -- comment out this loop to avoid any sql queries */
	foreach ( $newnums as $newnum ){
		$mysqli->query("INSERT INTO poc_list (poc,assigned,contact_code) VALUES ('$newnum[0]','1','$newnum[1]')") or die ($mysqli->error);
	}
	
	/* Test Section see numbers to be added (if any) */
	// var_dump($incontact_numbers); echo "<br><br>";  // #'s labeled 'Available' in inContact
	// var_dump($num_in_db); echo "<br><br>";		   // 'Available' #'s already in DB
	// var_dump($newnums);							   // Numbers in inContact but not in DB (difference)
	
} else {  // if numbers ARE found in db add only those non-existing
	$not_exist_nums = array_diff($incontact_numbers, $num_in_db);
	
	if(!empty($not_exist_nums)){ // if #'s need to be added to db
		$case = 13;
		echo "case 2<br>";
		foreach( $not_exist_nums as $number ){
			foreach( $poc as $contact ){
				if( $number == $contact->PhoneNumber){
					$newnums[] = array($contact->PhoneNumber, $contact->ContactCode);
				}
			}
		}
	
		/* adds to DB -- comment out this loop to avoid any sql queries */
		foreach ( $newnums as $newnum ){
			$mysqli->query("INSERT INTO poc_list (poc,assigned,contact_code) VALUES ('$newnum[0]','1','$newnum[1]')") or die ($mysqli->error);
		}
		
		/* Test Section see numbers to be added (if any) */
		// var_dump($incontact_numbers); echo "<br><br>";  // #'s labeled 'Available' in inContact
		// var_dump($num_in_db); echo "<br><br>";		   // 'Available' #'s already in DB
		// var_dump($newnums);							   // Numbers in inContact but not in DB (difference)
		
	} else { // if NO #'s need to be added, all exist
		// do nothing
		$case = 14;
	}

}

/* Summary Email */
switch($case){
	case 12:
	mail("ericr@csg-email.com", "get_poc.php success summary", "Added all, no numbers in DB");
	break;
	case 13:
	$n = count($not_exist_nums);
	mail("ericr@csg-email.com", "get_poc.php success summary", "added $n new number(s)");
	break;
	case 14:
	mail("ericr@csg-email.com", "get_poc.php success summary", "All Exist, nothing new added");
	break;
}

?>