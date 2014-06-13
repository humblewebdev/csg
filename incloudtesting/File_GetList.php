<?php

include "soapconnection.php";
include "dbc.php";

$time = strtotime($fdt);
$cTime = ($time + (60*60*7));

mysql_query("TRUNCATE TABLE file_list") or die (mysql_error());

$one = "CallLog\\";
$two = "*.*\\";
$parameters = array('applicationId' => $appID, 'path' => $one.$two );

$dirlist = array($client->File_GetList($parameters));
$dirs = $dirlist[0]->File_GetListResult->inFile;

$final = array();

for ( $i = 1; $i < 6; $i++ ){
	$record = array_pop($dirs);
	$folder = $record->FileName;
	$path = "CallLog\\$folder\\*.*";

	$params = array('applicationId' => $appID, 'path' => $path );
	$flist = array($client->File_GetList($params));
	$files = $flist[0]->File_GetListResult->inFile;
	
	//var_dump($files);

	$str = "CallLog\\$folder\\";
	$fpath = addslashes($str);
	foreach ( $files as $file ){
		$desc_one = '/^farm/';
		$desc_two = '/^Farm/';
		$desc_three = '/^FAST/';
		if ( preg_match($desc_one, ($file->FileName)) || preg_match($desc_two, ($file->FileName)) || preg_match($desc_three, ($file->FileName)) ){
			$date = $file->Date;
			$cdate = strtotime($date);
			//echo $cTime."<-- ctime & cdate -->".$cdate."<br>";
				if ( $cdate < $cTime && $cdate > ($cTime-6000)  ){
					array_push($final, $fpath.$file->FileName);
					// array_push($time, $date);
				}
		}
	}
}

var_dump($final);

 foreach ( $final as $name ){
	 mysql_query("INSERT INTO file_list (fname) VALUES ('$name')") or die (mysql_error());
 }
 
$last = mysql_insert_id();
mysql_query("UPDATE file_list SET nvalue = '$last' WHERE id = 1 ") or die (mysql_error());


// var_dump($last);


?>