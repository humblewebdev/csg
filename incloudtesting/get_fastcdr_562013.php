<?php
/*-------------------------------------------------------------------------------------*/
/* Name: 		get_fastcdr.php													  	   */
/* Author:		Eric Ruiz										  					   */
/* Company:		CSG																	   */
/* Date:		April 2013														       */							
/* Usage:		pulls an n day interval call detail report for specified start end date*/
/*-------------------------------------------------------------------------------------*/

include "soapconnection.php";

$gTotal = 0;

/* initialize error vars */
$error_msg = '';
$fail = 0;

/* specify start end dates */
$end = $fdt;
$ftime = new DateTime('now');
$interval = new DateInterval('PT01H59M59S');
$newstart = $ftime->sub($interval);
$start = $ftime->format('Y-m-d\TH:i:sP');

for( $i=0; $i < 7; $i++){

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

empty($rec);
empty($cabrera_rec);
empty($cdrcall);
empty($cdrs);
empty($records);
empty($load);
empty($recs);

/* set parameters and call client */
try {
$parameters = array('applicationId' => $appID, 'reportNo' => 350047, 'startDate' => "$start", 'endDate' => "$end" );
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

$flag = 0;
$farm_rec = array();
$recs = $records->CallDetailReport;

foreach ( $recs as $rec ){
	if ( ($rec->skill_no) == 173145 ){
		// echo $rec->campaign_no . " " . $rec->campaign_name;
		
		$cabrera_rec[] = $rec;
	}
}

// foreach ( $cabrera_rec as $rec ){
// echo "<br><br>";
// var_dump($rec);
// }


foreach ( $cabrera_rec as $rec ){
	switch($rec->Disp_Code){
		case 3828:
			$disp["eoi"]++;
			$totals["csgTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 3399:
			$disp["supp"]++;
			$totals["csgTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 644:
			$disp["pymnt"]++;
			$totals["csgTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 4562:
			$disp["xfrclms"]++;
			$totals["xfrAgntTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 4561:
			$disp["xfrnwbus"]++;
			$totals["xfrAgntTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 4563:
			$disp["xfrothr"]++;
			$totals["xfrAgntTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 4560:
			$disp["xfrrtrn"]++;
			$totals["xfrAgntTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 3830:
			$disp["xfrbris"]++;
			$totals["xfrFarmTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
		case 3288:
			$disp["xfrbill"]++;
			$totals["xfrFarmTotal"]++;
			$gTotal++;
			// echo $rec->Disp_Name." <br>";
			break;
	}
}
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Eric Ruiz <ericr@csg-email.com>' . "\r\n";
$message = "

eoi={$disp["eoi"]}<br>
supp={$disp["supp"]}<br>
pymnt={$disp["pymnt"]}<br>
xfrclms={$disp["xfrclms"]}<br>
xfrnwbus={$disp["xfrnwbus"]}<br>
xfrothr={$disp["xfrothr"]}<br>
xfrrtrn={$disp["xfrrtrn"]}<br>
xfrbris={$disp["xfrbris"]}<br>
xfrbill={$disp["xfrbill"]}<br>
total=$gTotal<br><br>
Start: $start<br>
End: $end

";

if ( mail("ericr@csg-email.com", "Loop $i", $message, $headers) ){
	echo "Email Successful<br>";
} else {
	echo "Email Failed";
}

$end = $start;
$tempstart = $newstart->sub($interval);
$start = $tempstart->format('Y-m-d\TH:i:sP');



}

/* Calculate percentages */
$eoi = ($disp["eoi"] / $gTotal)*100; $peoi = sprintf("%.2f", $eoi);
$supp = ($disp["supp"] / $gTotal)*100; $psupp = sprintf("%.2f", $supp);
$pymnt = ($disp["pymnt"] / $gTotal)*100; $ppymnt = sprintf("%.2f", $pymnt);
$xfrclms = ($disp["xfrclms"] / $gTotal)*100; $pxfrclms = sprintf("%.2f", $xfrclms);
$xfrnwbus = ($disp["xfrnwbus"] / $gTotal)*100; $pxfrnwbus = sprintf("%.2f", $xfrnwbus);
$xfrothr = ($disp["xfrothr"] / $gTotal)*100; $pxfrothr = sprintf("%.2f", $xfrothr);
$xfrrtrn = ($disp["xfrrtrn"] / $gTotal)*100; $pxfrrtrn = sprintf("%.2f", $xfrrtrn);
$xfrbris = ($disp["xfrbris"] / $gTotal)*100; $pxfrbris = sprintf("%.2f", $xfrbris);
$xfrbill = ($disp["xfrbill"] / $gTotal)*100; $pxfrbill = sprintf("%.2f", $xfrbill);

/* Calculate overall totals */
$csg = ($disp["eoi"] + $disp["supp"] + $disp["pymnt"]);
$csgTotal = ( $csg / $gTotal)*100; $pcsgTotal = sprintf("%.2f", $csgTotal);
$agntTotal = ($totals["xfrAgntTotal"] / $gTotal)*100; $pagntTotal = sprintf("%.2f", $agntTotal);
$farmTotal = ($totals["xfrFarmTotal"] / $gTotal)*100; $pfarmTotal = sprintf("%.2f", $farmTotal);



$message = "

<html>
<head>
  <title> Results for Aaron Cabrera</title>
</head>
<body>
  <table rules=\"all\" style=\"border-color: #666;\" cellpadding=\"10\">
    <tr>
      <th><strong>Aaron Cabrera start - end</strong></th><th>     Total</th><th>     Percentage</th>
    </tr>
    <tr>
      <td>Evidence of Ins / Lien Holder Verif</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["eoi"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$peoi</td>
    </tr>
    <tr>
      <td>General Support</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["supp"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$psupp</td>
    </tr>
	<tr>
      <td>Payment Only</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["pymnt"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ppymnt</td>
    </tr>
	<tr>
      <td>Transfer to Agent's Ofc Claims/Cancel Req</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["xfrclms"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pxfrclms</td>
    </tr>
	<tr>
      <td>Transfer to Agent's Ofc New Business</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["xfrnwbus"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pxfrnwbus</td>
    </tr>
	<tr>
      <td>Transfer to Agent's Ofc Other</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["xfrothr"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pxfrothr</td>
    </tr>
	<tr>
      <td>Transfer to Agent's Ofc Returned Call</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["xfrrtrn"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pxfrrtrn</td>
    </tr>
	<tr>
      <td>Transfer to Claims, Bristol, Foremost, CS</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["xfrbris"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pxfrbris</td>
    </tr>
	<tr>
      <td>Transfer to SS/Billing</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$disp["xfrbill"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pxfrbill</td>
    </tr>
	<tr>
      <th><strong>Total Call Breakdown:</th><th>Total</th><th>Percentage</strong></th>
    </tr>
	<tr>
      <td>Resolved by CSG</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$csg</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pcsgTotal</td>
    </tr>
	<tr>
      <td>Transfer to Agent</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$totals["xfrAgntTotal"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pagntTotal</td>
    </tr>
	<tr>
      <td>Transfer to Farmers</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$totals["xfrFarmTotal"]}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pfarmTotal</td>
    </tr>
	<tr>
      <td>Total Calls:</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$gTotal</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
    </tr>
  </table>
</body>
</html>

";
														  
// ----------------------------------------------------------------------

// TOTAL CALL BREAKDOWN:  From $sta To $en	 	Percentage	
// Resolved by CSG	
// Transfer to Agent	
// Transfer to Farmers
// Total Calls:
// Total managed by CSG resolved without agency	

/* write to .csv file */
// foreach ( $headers as $header ){
	// $message = $header."				";
	// fputcsv($fh, $header);
// }

// Sends HTML mail, Content-type header must be set
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: Eric Ruiz <ericr@csg-email.com>' . "\r\n";

if ( mail("ericr@csg-email.com", "Testing FAST Reports", $message, $headers) ){
	echo "Email Successful";
} else {
	echo "Email Failed";
}




/*

if ( $fail == !0 ){
mail("ericr@csgemail.com", "error get_cdr.php", $error_msg);
}

 close file handle 
fclose($fh);

*/

?>