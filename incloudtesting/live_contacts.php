<?php 

include "soapconnection.php"; 
//$campaigns = array(

echo "<br><br>";

$parameters = array('applicationId' => $appID, 'campaigns' => array(64193), 'skills' => array(), 'teams' => array(), 'mediaTypes' => array());

$contactcall = array($client->Contact_GetLiveListExt($parameters));
$contacts = $contactcall[0]->Contact_GetLiveListExtResult->inContact;
$count=0;
if ( $contacts != NULL ){
	foreach ($contacts as $contact){
		echo "<b>Skill:</b> " . $contact->SkillName . "<br>";
		echo "<b>ContactID:</b> " . $contact->ContactID . "<br><br>";
		$count++;
	}
} else {
	echo "<br><br>No Live Contacts<br><br>";
}

echo "Count: " . $count . " Live Calls";
?>