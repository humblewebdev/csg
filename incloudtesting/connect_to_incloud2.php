<?php
 // Below Code is Used to Capure Errors, Remove when Unneeded
 ini_set('display_errors', 1);
 ini_set('log_errors', 1);
 ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
 error_reporting(E_ALL);
 ini_set("soap.wsdl_cache_enabled", "0");
 // Above Code is Used to Capure Errors, Remove when Unneeded


// Set Header Variables
$username = "CSGPartner";
$password = "GjW%4iLk^6";
$appID = 'b0643d47-3c20-4c95-969f-caab2841f9fa';
$url = 'https://incloudws.incontact.com/inCloudWS.asmx?WSDL';
$xmlns = 'inCloudService';

 $options = array(  'soap_version' => SOAP_1_2, 
					'trace' => true, 
					'style' => SOAP_RPC,
                    'use' => SOAP_ENCODED,
					'Username' => $username, 
					'Password' => $password);

// setup a SOAP client
$client = new SOAPClient($url,$options);

// create SOAP header
$headerbody = array('Username' => $username, 'Password' => $password);
$header = new SOAPHeader($xmlns, 'AuthenticationHeader', $headerbody, false);

$client->__setSOAPHeaders($header);

$appIDrequest = array('applicationId' => $appID);
/*$a = array('applicationId' => $appID, 'agentNo' => 133320);
$c = array($client->Agent_Find($a));
$d = array($client->Agent_GetActiveList($appIDrequest));
$e = array($client->Agent_GetActiveList($appIDrequest)->Agent_GetActiveListResult->inAgent);
*/
// client calls

$testconn = array($client->TestConnection());
$testauth = array($client->TestAuthenticationConnection());
$testid = array($client->TestApplicationConnection($appIDrequest));

?>
<br><br><b><font color="blue">Test Connection:</b> </font><?php var_dump ($testconn);  ?>
<br><br><b><font color="blue">Test Authentication:</b> </font><?php var_dump ($testauth);  ?>
<br><br><b><font color="blue">Test Application Connection:</b> </font><?php var_dump ($testid);  ?>
<br><br>

<?php //For Loop to Provide all Active Users info
$agal = array($client->Agent_GetActiveList($appIDrequest));
$agalr = $agal[0]->Agent_GetActiveListResult->inAgent[$i];
foreach($agal as $msg){
echo "Active List # (" . $i . ")&nbsp;&nbsp;&nbsp;";

?></br><?php echo "AgentNo: " . $msg->AgentNo; ?></br>
<?php echo "Agent Name: " . $msg->FirstName . " " . $msg->LastName; ?></br>
<?php echo "Email: " . $msg->Email; ?></br>
<?php echo "Current Skill Name: " . $msg->CurrentSkillName; ?></br>
<?php echo "Team Name: " . $msg->TeamName; ?></br>
<!--<?php// echo "Reports to: " . $k->ReportToFirstName . " " . $k->ReportToLastName; ?></br>-->
<?php echo "Status: " . $msg->Status; ?></br>
<?php echo "Last Login: " . $msg->LastLogin; ?>

 <br><br> <?php
}
//End of For Loop
var_dump ($d);
?>





