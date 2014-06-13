<?php

echo "i started<br>";

include 'C:/Users/administrator.CULTURE/Desktop/Swift-5.0.1/lib/swift_required.php';

echo "about to create transport<br>";

try {
$transport = Swift_SmtpTransport::newInstance('smtp.cultureservicegrowth.com', 25);
	$transport->setUsername('administrator');
	$transport->setPassword('L3v1t0n5');
} catch (Exception $e) {
	echo 'Error: ', $e->getMessage(), "<br>";
}
	
echo "about to create mailer\n";
$mailer = Swift_Mailer::newInstance($transport);

echo "about to create a msg";
$message = Swift_Message::newInstance();

	$message->setSubject('Test SwiftEmail');
	
	$message->setFrom(array('ericr@csgemail.com' => 'Eric Ruiz'));
	
	$message->setTo(array('ericr@csg-email.com' => 'Eric Herman Ruiz'));
	
	$message->setBody('This is a test email from the new SwiftEmail Library I installed.');
	
	$message->addPart('<q>Here is the message itself</q>', 'text/html');
	
	$message->attach(Swift_Attachment::fromPath('C:/data.txt'));

$result = $mailer->send($message);

echo "I made it here";

 ini_set('display_errors', 1);
 ini_set('log_errors', 1);
 ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
 error_reporting(E_ALL);
 //ini_set("soap.wsdl_cache_enabled", "0");


?>