<?php
/*************************** Start of Custom Functions *****************************************************/

function assignedAgents($skillNo){
include 'soapconnection.php';
//Get List of CSG Agents 
$d = array($client->Agent_GetLiveList($appIDrequest));
$b = $d[0]->Agent_GetLiveListResult->inAgent;

//Loop Through Every Agent in List and save variables to needed properties
$target = '/^FAST/';
foreach($b as $person){

//If Agent is a part of the FAST Team put them into $anums array along with their properties
if( preg_match($target, ($person->TeamName) ) ){
$anums[] = array( "AgentNo" => $person->AgentNo, "First" => $person->FirstName, "Last" => $person->LastName );
}
}

//Loop through Each Fast Agent
foreach($anums as $agent){

//Search for all skill associated with current Agent
$find = array('applicationId' => $appID, 'agentNo' => $agent['AgentNo']);
$result = $client->AgentSkill_GetList($find);
$rb = $result->AgentSkill_GetListResult->inAgentSkill;

//Counts the amount of skills assigned to the Agent and saves their fullname to a variable
$countrb = count($rb);
$agentname = $agent['First'] . " " . $agent['Last'];

//Loop through every skill returned for the specified agent and only return the agents that have the specified skill Assigned
foreach($rb as $inner){
if($inner->SkillNo == $skillNo){

//Save all Assigned Agents into accessible array with their details
$assigned_agents[] = array( 
"AgentName" => $agentname, 
"AgentNo" => $inner->AgentNo, 
"SkillNo" => $inner->SkillNo, 
"Proficiency" => $inner->Proficiency,
"LastMod" => $inner->LastModified
);
}
}
}
return $assigned_agents;

}

$assigned_agents = assignedAgents("207212");
 
 var_dump($assigned_agents);  //Will display the array that was returned to view if you want

/*************************** End of Custom Functions *****************************************************/


/************** Note: How to Use Function ***********************************************

 To use the function above, assign a variable to the function
 passing through the skill number and that variable will contain 
 the returned array with the desired agents.
 
 Ex.
 
 $assigned_agents = assignedAgents("207212");
 
 var_dump($assigned_agents);  //Will display the array that was returned to view if you want
 
	echo "Number of Agents assigned to Client: " . count($assigned_agents) . <br>;
	echo "<table><tr>
		  <th>Agent Number</th>
		  <th>Agent Name</th>
		  <th>Skill Number</th>
		  <th>Proficiency</th>
		  <th>Last Modified</th>
		  </tr>";

	foreach($assigned_agents as $aa){
	echo "<tr>
		  <td>{$aa['AgentNo']}</td>
		  <td>{$aa['AgentName']}</td>
		  <td>{$aa['SkillNo']}</td>
		  <td>{$aa['Proficiency']}</td>
		  <td>{$aa['LastMod']}</td>
		  </tr>";
	}

	echo "</table>";
	
*******************************************************************************************/
?>