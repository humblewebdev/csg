<?php 
include 'db_connect.php';

$type=$_GET['type'];

if($type=="bulk_update_approve"){ 

	foreach($_POST['bulk_action_id'] as $uid){
     $mysqli->query("update users set approved='1', banned='0' where users_id='$uid';") or die($mysqli->error);
	 echo $uid . " Approved! \n";
	}
}

if($type=="bulk_update_lock"){ 

	foreach($_POST['bulk_action_id'] as $uid){
     $mysqli->query("update users set banned='1' where users_id='$uid';") or die($mysqli->error);
	 echo $uid . " Locked! \n";
	}
}

?>