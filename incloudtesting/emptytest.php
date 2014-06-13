<?php

include "dbc.php";

//Check for POCs else STOP and Notify User
$chksql= mysql_query("SELECT * FROM test_table") or die (mysql_error());
$pocarr = mysql_fetch_array($chksql) or die (mysql_error());

if ( !empty($pocarr) ){
	echo "array empty<br>";
} else {
	echo "not empty<br>";
}

?>