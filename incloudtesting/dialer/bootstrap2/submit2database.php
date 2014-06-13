<?php
include "db_connect.php";

if(isset($_POST['submit']))
   {
     $FileDirectory = 'files/';
	 $target = $FileDirectory.basename($_FILES['filename']['name']);
	if ($_FILES['filename']['size'] > 0){
		move_uploaded_file($_FILES['filename']['tmp_name'], $target);
	}
	
	$handle = fopen("$target", "r");
	$column_header=fgetcsv($handle);
     while (($data = fgetcsv($handle, 100000, ",")) !== FALSE)
     {
		//echo "$data[0] $data[1] $data[2] $data[3]<br>";
       $import="INSERT into dialer_list(phone_number, policy_number, cancel_date, amount_due) values('$data[0]','$data[1]','$data[2]','$data[3]')";
       $mysqli->query($import) or die(mysql_error());
     }
     fclose($handle);
     print "Import done";
   }

	
   
?>