<?php

// Set Header Variables
$username = 'CSGPartner';
$password = 'GjW%4iLk^6';
$appID = '59f2612a-1386-4f96-af4c-5748d904fbfc';
$namespace = 'https://incloudws.incontact.com/inCloudWS.asmx?WSDL';
$ns = 'inCloudService';

// setup a SOAP client
$client = new SOAPClient($namespace,array('trace' => true, "soap_version" => SOAP_1_2));

// create SOAP header
$headerbody = array('Username' => $username, 'Password' => $password);
$header = new SOAPHeader($ns, 'AuthenticationHeader', $headerbody, false);

// Set Header
$client->__setSOAPHeaders($header);

// Set Body
$appID = array('applicationId' => $appID);
// client calls
$list = $client->Agent_GetList($appID);

?>

<br><b>Test Connection:</b> <?php var_dump($client->TestConnection()); ?>
<br><b>Test Auth:</b> <?php var_dump($client->TestAuthenticationConnection()); ?>
<br><b>Test AppID:</b> <?php var_dump($client->TestApplicationConnection($appID)); ?>
<br><b>Agent_GetList:</b> <?php var_dump($list); ?> 
