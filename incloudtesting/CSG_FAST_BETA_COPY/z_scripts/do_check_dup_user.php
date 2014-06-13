<?php 
$email = $_GET['email'];
$agent_code = $_GET['agent_code'];		

include 'db_connect.php';
$dup_check = 0;
$row_cnt_result = $mysqli->query("SELECT users_id FROM users WHERE email='$email' OR agent_code='$agent_code';") or die(mysqli_error($mysqli));

/* check to see if user already exists */
$row_cnt = $row_cnt_result->num_rows;
if ($row_cnt > 0) {
 $dup_check = 1;
}		  

?>
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var email = '<?php echo trim($email); ?>';
	var agent_code = '<?php echo trim($agent_code); ?>';
	var dup_check = <?php echo $dup_check; ?>;
	
    if(agent_code != '' && dup_check == 1){	
	document.getElementById("dup_agentcode").innerHTML = "<font color='red'>Invalid: This user is already registered!</font>";
    document.getElementById("agent_code").value = ""; //Clear Value
	}
	
	if(email != '' && dup_check == 1){	
	document.getElementById("dup_email").innerHTML = "<font color='red'>Invalid: This user is already registered!</font>";
    document.getElementById("email").value = ""; //Clear Value
	}
	
	});
</script>
