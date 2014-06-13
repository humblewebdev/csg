<?php

/* initialize error vars */
$error_msg = '';
$fail = 0;

/* initialize disposition count to zero */
$disp = array(
"eoi" => 0,
"supp" => 0,
"pymnt" => 0,
"xfrclms" => 0,
"xfrnwbus" => 0,
"xfrothr" => 0,
"xfrrtrn" => 0,
"xfrbris" => 0,
"xfrbill" => 0,
);

$totals = array(
"xfrAgntTotal" => 0,
"xfrFarmTotal" => 0,
"csgTotal" => 0,
);

$flag = 0;

$FileDirectory = 'files/';
$target = $FileDirectory.basename($_FILES['csv_file']['name']);

if ($_FILES['csv_file']['size'] > 0){
	move_uploaded_file($_FILES['csv_file']['tmp_name'], $target);
}


$campaign = "/".$_POST["camplist"]."/";
$skill_list = $_POST["skilllist"];


//var_dump($skill);
	
$keys = array('contact_id', 'master_contact_id', 'contact_code', 'media_name', 'contact_name', 'ANI_DIALNUM', 'skill_no', 'skill_name', 'campaign_no',
	'campaign_name', 'agent_no', 'agent_name', 'team_no', 'team_name', 'SLA', 'start_date', 'start_time', 'prequeue', 'inqueue', 'agent_time', 
	'post_queue', 'ACW_Time', 'Total_Time', 'Abandon_Time', 'Routing_Time', 'abandon', 'callback_time', 'Logged', 'Hold_Time', 'disp_code', 
	'disp_name', 'disp_comments');


$data = array();
$report = array();

if (($fh = fopen("$target", "r")) !== FALSE){
	while (($row = fgetcsv($fh, ",")) !== FALSE){
            $data[] = array_combine($keys, $row);
        }
        fclose($fh);
	}

foreach ($data as $rec){
	array_push($report, $rec);
}

$fast = '/FAST/';
$disp_code = '/0/';

foreach ( $report as $rec ){
	$skill_name = $rec["skill_name"];
	$campaign_name = $rec["campaign_name"];
	$disposition = $rec["disp_code"];
	//echo "$skill_name<br>$campaign_name<br>$disposition<br>---------<br>---------<br>";
	foreach ( $skill_list as $skill ){
	//echo "$skill<br>$campaign_name<br>$disposition<br>---------<br><br>";
		if ( preg_match($campaign_name, $campaign) &&  preg_match($skill_name, $skill) && !preg_match($disp_code, $disposition) ){
			echo $rec["skill_name"]."<br>";
			echo $rec["agent_name"]."<br><br>";
		} else { }
	}
		
}

?>