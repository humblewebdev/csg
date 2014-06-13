<?php

$newMemberName = $_POST['name'];
$newMemberEmail = $_POST['email'];
$newMemberMsg = $_POST['message'];

try{
	mail('utsapaintballclub@gmail.com', "$newMemberName requesting membership", $newMemberMsg);
} catch (Exception  $e){
	$error = $e->getMessage();
	mail('utsapaintballclub@gmail.com', 'Join Form Email Error', "Email to paintball club error shown below<br>$error");
 }

 $welcomemsg = "Hello $newMemberName,\n\nWe're glad that you are interested in joing the club. We'll review your request within the next few days and will be contacting you with further information about joining. In the mean time use the link on our Contact page to like our Facebook page or visit us at www.facebook.com/utsapaintballclub.\n\nThank you,\n\nUTSA Paintball Club";
 
 try{
	mail($newMemberEmail, "Thanks for your interest in UTSA Paintball", $welcomemsg);
} catch (Exception $e){
	$error = $e->getMessage();
	mail('utsapaintballclub@gmail.com', 'Welcome Message Error', "Could not send user a welcome message error shown below<br>$error");
 } 

 echo "Thanks $newMemberName, we'll be in touch soon!";
 
?>