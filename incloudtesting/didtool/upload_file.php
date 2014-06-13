<?php
include "dbc.php";

$allowedExts = array("csv");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ( ($_FILES["file"]["size"] < 20000) && in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
	
	$fname = $_FILES["file"]["tmp_name"];
	
	$row = 1;
	if (($fp = fopen($fname, "r")) !== FALSE) {
		echo "<br><br><b>Added Records</b> ";
		while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
			$num = count($data);
			echo "<br /></p>\n";
			$row++;
			for ($c=0; $c < $num; $c++) {
				if($c<3){
				echo $data[$c] . " -- \n";
				} else {
				echo $data[$c] . " \n";
				}
			}
			$mysqli->query("INSERT INTO did_list (username, sip_username, DID, sip_displayname, sip_auth_password, sip_auth_username, domain) VALUES ('AVAILABLE', '$data[0]', '$data[1]', '$data[0]', '$data[3]', '$data[2]', 'callnat.onvoip.net')");
    }
	}
	
	fclose($fp);
    }
  }
else
  {
  echo "Invalid file";
  }
?>