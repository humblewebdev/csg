<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpwd = 'QwertY4321';
$conn = mysql_connect($dbhost, $dbuser, $dbpwd);
if(! $conn){ die ('Could not connect: ' . mysql_error()); }

$tableName  = 'poc_list';
$backupFile = "C:\\Users\\ericrui\\Desktop\\poc_list.sql";
$query = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
mysql_select_db('nssoluti_csgfast');
$result = mysql_query($query, $conn);

if ( !$result ){
die('could not backup data: ' . mysql_error());
} else {
echo "backed up successfully";
}

?>