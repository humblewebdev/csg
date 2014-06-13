<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		get_cdr.php													  		   */
/* Author:		Eric Ruiz										  					   */
/* Company:		CSG																	   */
/* Date:		January 2013														   */							
/* Usage:		pulls a 1 day interval call detail report for specified start end date */
/*-------------------------------------------------------------------------------------*/

include "soapconnection.php";

$error_msg = '';
$fail = 0;

/* specify start end dates */
//$end = $fdt;
$ftime = new DateTime('now');
// $interval = new DateInterval('PT24H59M59S');
// $ftime->sub($interval);
$start = new DateTime('2013-01-30 05:00:00');
$start = $start->format('Y-m-d\TH:i:sP');
$end = new DateTime('2013-01-30 12:45:00');
$end = $end->format('Y-m-d\TH:i:sP');

/* set parameters and call client */
try {
$parameters = array('applicationId' => $appID, 'reportNo' => 350048, 'startDate' => "$start", 'endDate' => "$end" );
$cdrcall = array($client->CallDetailReport_Run($parameters));
} catch (Exception $e){
	$fail = 1;
	$error_msg = $error_msg . $e->getMessage() . "</b><br>";
}

/* extract xml data */
$cdrs = $cdrcall[0]->CallDetailReport_RunResult;
$records = $cdrs->any;
$load = simplexml_load_string($records);
$records = $load->NewDataSet;

$desc_one = '/^FAST/';
$desc_two = '/^Farmers/';
$flag = 0;
$farm_rec = array();
$recs = $records->CallDetailReport;

foreach ( $recs as $rec ){
	if ( preg_match($desc_one, ($rec->campaign_name)) || preg_match($desc_two, ($rec->campaign_name))){
		//echo $rec->campaign_no . " " . $rec->campaign_name;
		$farm_rec[] = $rec;
	}
}

/* create file handle and filename */
$mark = $ftime->format('md20y');
$dir = 'D:\websites\cultureservicegrowth.com\inCloudtesting';
$fname = "DetailReport_$mark.csv";
$fh = fopen("$dir\\$fname", 'w') or die("Unable to open DetailReport_$mark.txt");
$headers = array( array('contact_id', 'master_contact_id', 'contact_code', 'media_name', 'contact_name', 'ANI_DIALNUM', 'skill_no', 'skill_name', 'campaign_no',
	'campaign_name', 'agent_no', 'agent_name', 'team_no', 'team_name', 'SLA', 'start_date', 'start_time', 'prequeue', 'inqueue', 'agent_time', 
	'post_queue', 'ACW_Time', 'Total_Time', 'Abandon_Time', 'Routing_Time', 'abandon', 'callback_time', 'Logged', 'Hold_Time', 'disp_code', 
	'disp_name', 'disp_comments'));
	
/* write to .csv file */
foreach ( $headers as $header ){
	fputcsv($fh, $header);
}

foreach ($farm_rec as $rec){
		$arr = (array) $rec;
		fputcsv($fh, $arr);
}

if ( $fail == !0 ){
mail("ericr@csgemail.com", "error get_cdr.php", $error_msg);
}

/* close file handle */
fclose($fh);

?>