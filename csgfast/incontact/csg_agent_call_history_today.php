<?php
/**
* Made by Amber Bryson
* 1/2/2013
* table which will populate with the logged in agent's call history.
**/
session_start();
include('custom_incontact_functions.php');
include '../z_scripts/db_connect.php';
$skillno = $_SESSION['skillno'];

	
	//grab today's history
	$results = $mysqli->query("SELECT * FROM csg_fast_prod.incontact_contact_list_today WHERE skillno='$skillno'") or die($mysqli->error);

echo"<table class='table'>
	<tbody>";
		while($row = mysqli_fetch_array($results)){
		
			$agentno = $row['agentno'];
			$agent_qry = $mysqli->query("SELECT firstname, lastname, agentno FROM csg_company.incontact_agent_list WHERE agentno='$agentno'") or die($mysqli->error);
			$agent_info = mysqli_fetch_array($agent_qry);
			
			//get minutes on the call
			$total_time = $row['agentseconds']/60.0;
			$total_time = number_format($total_time,2); 
			
			//get the start and end time into a more readable format
			$start_date = new DateTime($row['startdate']);
			$end_date = new DateTime($row['enddate']);
			$start_date = $start_date->format("m/d/y g:i A");
			$end_date = $end_date->format("m/d/y g:i A");
			
			//grab call description and check if empty as to decide what to display
			$call_description = $row['disposition_comm'];	
			$ani_temp = $row['from_num'];
			$ani = preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $ani_temp);

			
		echo"<tr>
				<th width='10%'>".$row['contactid']."</th>
				<th width='13%'>".$ani."</th>
				<th width='12%'>".$agent_info['firstname']." ".$agent_info['lastname']."</th>
				<th width='12%'>".$start_date."</th>
				<th width='11%'>".$end_date."</th>
				<th width='10%'>".$total_time."</th>";
				if($call_description){
					echo "<th width='30%'>$call_description<th>";
				}else{
					echo "<th width ='30%'><font color='red'>No notes for this call.</font></th>";
				}
			echo"</tr>";			
		}	
	echo"</tbody>
</table>";
?>