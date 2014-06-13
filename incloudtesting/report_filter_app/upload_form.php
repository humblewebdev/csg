<?php include "soapconnection.php"; ?>

<html>

<form action="csv_parse.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="csv_file" id="file"><br><br>

<label for="camplist">Select Campaign:</label>
<select name="camplist">
  <option value="FAST">FAST</option>
  <option value="Farmers">Farmers</option>
  <option value="Nationwide">Nationwide</option>
  <option value="Con-way">Con-way</option>
</select><br><br>

<label for="skilllist">Select Skill:<br></label>

	<?php 
	$call = array($client->Skill_GetList($appIDrequest));
    $skills = $call[0]->Skill_GetListResult->inSkill;
    foreach($skills as $skill){
		if ( /* FAST LOGIC */(preg_match('/FAST/', $skill->SkillName) && !preg_match('/OB/', $skill->SkillName) && !preg_match('/Outbound/', $skill->SkillName) && !preg_match('/Chat/', $skill->SkillName) ) || /* NW LOGIC */( preg_match('/NW/', $skill->SkillName) && !preg_match('/Outbound/', $skill->SkillName) && !preg_match('/Chat/', $skill->SkillName) ) || /* Conway LOGIC */preg_match('/Con-way/', $skill->SkillName) || /* Farm LOGIC */(preg_match('/Farmers/', $skill->SkillName) && !preg_match('/Chat/', $skill->SkillName) ) ){
			if ( preg_match('/^Active$/', $skill->Status) ){
				echo "<input type='checkbox' name='skilllist[]' value='$skill->SkillName'>$skill->SkillName</option><br>";
			}
		}
	}
	?>
<br><br>

<input type="submit" name="submit" value="Submit">
</form>

</html>

<?php //var_dump($skills); ?>