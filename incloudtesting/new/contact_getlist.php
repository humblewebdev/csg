<?php
include "../soapconnection.php";

//Custom Functions

//Function to Convert stdClass Objects to Multidimensional Arrays
function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}

//Function to search for a value in a multidimentional array and return array index key
function searchForId($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['SkillName'] === $id) {
           return $key;
       }
   }
   return null;
}	

date_default_timezone_set('America/Chicago');			
$dt = new DateTime('now');								
$fdt = $dt->format('Y-m-d\TH:i:sP');	

//Sets Variables based on User Input   
$skill_input = $_POST['skillname'];
$hours = "PT" . $_POST['hours'] . "H59M59S";
?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" src="../DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="../DataTables-1.9.4/extras/ColVis/media/js/ColVis.js"></script>
		<script type="text/javascript" charset="utf-8" src="../DataTables-1.9.4/extras/ColReorder/media/js/ColReorder.js"></script>
		<script type="text/javascript" charset="utf-8" src="../DataTables-1.9.4/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="../DataTables-1.9.4/media/js/TableTools.js"></script>
		<script type="text/javascript" src="../DataTables-1.9.4/media/js/jquery.dataTables.editable.js"></script>
		<script src="../DataTables-1.9.4/media/js/jquery.jeditable.js" type="text/javascript"></script>
		<script type="text/javascript" src="../js/date_time.js"></script>

		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				
				oTable = $('#callstable').dataTable({
				    
		            "bJQueryUI": true,
					"sDom": /*'R<"H"TlCfr>t<"F"ip>'*/'<"H"TlCfr>t<"F"ip>',
					/*"oColVis": {"activate": "mouseover"},*/
		            "sPaginationType": "full_numbers",
					"sScrollY": "630px",
					"bPaginate": false,
					"aaSorting": [],
					"bStateSave": false,
					"bFilter": false,
					
					
					/*"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 1 ] }
		],*/
					"oTableTools": {
					"sSwfPath": "DataTables-1.9.4/media/swf/copy_cvs_xls_pdf.swf",
			"aButtons": ["print"/*,
{
"sExtends": "pdf",
"sButtonText": "Print PDF",
"mColumns": "visible"
},
{
"sExtends": "xls",
"sButtonText": "Export to Spreadsheet",
"mColumns": "all"
}*/
]
		}
					}).makeEditable();
			} );
		</script>	 	

 <style type="text/css" title="currentStyle">
			@import "../DataTables-1.9.4/media/css/demo_table_jui.css";
			@import "../DataTables-1.9.4/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
			@import "../DataTables-1.9.4/extras/ColReorder/media/css/ColReorder.css";
		    @import "../DataTables-1.9.4/extras/ColVis/media/css/ColVis.css";
			@import "../DataTables-1.9.4/media/css/TableTools_JUI.css";
		</style>
		
    
<div class="demo_jui">
   
<table cellspacing="0" cellpadding="0" cellspacing="0" border="0" valign="top" class="display" id="callstable" >
<thead>
<tr style="background: #CAE8EA url(../img/bg_header.jpg) no-repeat;">
<th>Skill</th>
<th>ContactID</th>
<th>Agent No.</th>
<th>From</th>
<th>To</th>
<th>Start Time</th>
<th>End Time</th>
<th>Hold Time</th>
<th>Total Dur.</th>
<th>Type</th>

</tr>

</thead>


<tfoot>
<tr>
<th>Skill</th>
<th>ContactID</th>
<th>Agent No.</th>
<th>From</th>
<th>To</th>
<th>Start Time</th>
<th>End Time</th>
<th>Hold Time</th>
<th>Total Dur.</th>
<th>Type</th>


</tr>
</tfoot>

<tbody>
<tr>
<td>		
<?php
echo "<u>Search Results for: \"$skill_input\"</u><br><br>";
$fail = 0;

/* specify start end dates */
$end = $fdt;
$ftime = new DateTime('now');
$interval = new DateInterval("$hours");
$ftime->sub($interval);
$start = $ftime->format('Y-m-d\TH:i:sP');

/* set parameters and call client */
try {
$parameters = array('applicationId' => $appID, 'startDate' => "$start", 'endDate' => "$end" );
$list = array($client->Contact_GetList($parameters));

$result = $list[0]->Contact_GetListResult->inContact;

//Converts Active List to a searchable multidimentional array
$multi_array = objectToArray($result);


$count=0;

if ( $result != NULL ){
	foreach ($result as $item){
	
	if(($item->SkillName)=="$skill_input"){
		echo "<td class='odd gradeX'>" . $item->SkillName . "</td>";
		echo "<td class='odd gradeX'>" . $item->ContactID . "</td>";
		echo "<td class='odd gradeX'>";
		if($item->AgentNo == 0){echo 'Caller Hung Up';} else {echo $item->AgentNo;}
		echo "</td>";
		echo "<td class='odd gradeX'>" . $item->From . "</td>";
		echo "<td class='odd gradeX'>" . $item->To . "</td>";
		echo "<td class='odd gradeX'>" . $item->StartDate. "</td>";
		echo "<td class='odd gradeX'>" . $item->EndDate . "</td>";
		echo "<td class='odd gradeX'>";
		if($item->HoldSeconds > 60){echo (substr(((($item->HoldSeconds)/60)), 0, 1)) . " min, " . (($item->HoldSeconds)%60) . " sec";} else {echo $item->HoldSeconds . " seconds";}
		echo "</td>";
		echo "<td class='odd gradeX'>";
		if($item->TotalDurationSeconds > 60){echo (substr(((($item->TotalDurationSeconds)/60)), 0, 1)) . " min, " . (($item->TotalDurationSeconds)%60) . " sec";} else {echo $item->TotalDurationSeconds . " seconds";}
		echo "</td>";
		echo "<td class='odd gradeX'>";
		if($item->OutboundSkill == false){echo 'Inbound Call';} else {echo 'Outbound Call';}
		echo "</td>";
		$count++;
	}
	}
	}


?>
</td>
</tr>
</tbody>
</table>
</div>
<?php
else {
	echo "<br><br>No Contacts<br><br>";
}

echo "Count: " . $count . " Total Calls";


} catch (Exception $e){
	$fail = 1;
	$error_msg = $error_msg . $e->getMessage() . "</b><br>";
}



?>