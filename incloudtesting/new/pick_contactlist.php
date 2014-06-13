<!DOCTYPE HTML>
<?php include '../soapconnection.php';?>
<html>

<form name="theform" id="theform" method="post" action="contact_getlist.php">
SkillName: <select class="selector_a" id="skillname" name="skillname">
            
			<?php 
			
			$d = array($client->Skill_GetList($appIDrequest));
            $b = $d[0]->Skill_GetListResult->inSkill;

            $i=-1;
            foreach($b as $skill){ $i++;

            $skill = $d[0]->Skill_GetListResult->inSkill[$i];  

            
           $name = $skill->SkillName;
		   $no = $skill->SkillNo;
		   $pattern = '/^FAST/';          
		   
		   if(preg_match($pattern, $name)){ ?>
		   
		   <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
	   
		   <?php
		   } // if close
		   
		   } // foreach close
		   ?>
			
           </select>
Hours From Now: <input name="hours" id="hours" type="number"/>	
<input type="submit" value="Submit">
</form>
</html>