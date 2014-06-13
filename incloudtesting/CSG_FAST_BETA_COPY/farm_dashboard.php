<div class="row-fluid">
	<div class="span6">		
		  <div class="well <?php echo $info_ui_color; ?>">
				<div class="well-header">
					<h5>Phone Info</h5>
				</div>
			<div class="well-content no-search">
				<form id="phoneinfo">
					<div class="form_row">
					</div>
					<div class="form_row">
						<label class="field_name span5">Main Phone</label>
						<div class="field">
							<input type="text" class="span6 mask-phone required" onkeyup="phonelist(this, 'Main');" name="mainphone--tosql_farm_incontact_info" placeholder="" value="<?php echo $info_mainphone; ?>">
						</div>
					</div>
					<div class="form_row">
						<label class="field_name span5">Second Phone</label>
						<div class="field">
							<input type="text" class="span6 mask-phone required" onkeyup="phonelist(this, 'Second');" name="secondphone--tosql_farm_incontact_info" value="<?php echo $info_secondphone; ?>" placeholder="">
						</div>
					</div>
					<div class="form_row">
						<label class="field_name span5">Cell Phone</label>
						<div class="field">
							<input type="text" class="span6 mask-phone required" onkeyup="phonelist(this, 'Cell');" name="cellphone--tosql_farm_incontact_info" placeholder="" value="<?php echo $info_cellphone; ?>">
						</div>
					</div>
					<div class="form_row">
						<label class="field_name">Route back calls to</label>
						<div class="field">
							<div class="span8 styled-select-other">
								<select class="select" id="routeback_phones" name="rback--tosql_farm_incontact_info">
									<option class="resizeoption" name="Main" value="<?php echo $info_mainphone; ?>" <?php if($info_mainphone == $info_rback){echo "selected"; }; ?>>Main: <?php echo formatPhone($info_mainphone); ?></option>
									<option class="resizeoption" name="Second" value="<?php echo $info_secondphone; ?>" <?php if($info_secondphone == $info_rback){echo "selected"; }; ?>>Second: <?php echo formatPhone($info_secondphone); ?></option>
									<option class="resizeoption" name="Cell" value="<?php echo $info_cellphone; ?>" <?php if($info_cellphone == $info_rback){echo "selected"; }; ?>>Cell: <?php echo formatPhone($info_cellphone); ?></option>
								</select>
							</div>
						</div>
					</div> 
					
					<div class="form_row">
							<br>
							<a href="#" class="btn btn-block update_user_data" formid="phoneinfo"><i class="icon-share"></i> Update</a>
					</div>
				</form>
			</div>
		  </div>
		  
		  <div class="well <?php echo $info_ui_color; ?>">
			<div class="well-header">
				<h5>Your Staff</h5>
				<ul class="nav nav-tabs pull-right">
					<li>
						<a class="icon" title="Add more staff?" id="showmorestaff" href="#" data-toggle="tab">
							<i class="icon-plus"></i><i class="icon-user"></i>
						</a>
					</li>
				</ul>
			</div>

			<div class="well-content no-search">
				<form id="stafflist">
				<div class="accordion" id="accordions">
				<?php for($staff = 1; $staff <= 6; $staff++){ if(${"info_staffname".$staff} == ""){ $nostaff =TRUE; } else {$nostaff=FALSE;}?>
					
					<div class="accordion-group <?php if($nostaff){ echo "hide"; } ?> staffobject">
						<div class="accordion-heading">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordions" href="#<?php echo "staff".$staff; ?>">
								<?php 
									if($nostaff){
										echo "<h4><i class='icon-plus'></i> &nbsp;Click to Add Employee Info</h4>"; 
									} else{
										echo "<h4><i class='icon-plus'></i> &nbsp;" . ${"info_staffname".$staff} ."</h4>"; 
									}
								?>
							</a>
						</div>
						<div id="<?php echo "staff".$staff; ?>" class="accordion-body collapse">
							<div class="accordion-inner">
								<div class="form_row">
									<div class="input-append bootstrap-timepicker field">	
										<input value="<?php echo ${"info_staff".$staff."open"}; ?>" name="<?php echo "staff".$staff."open"; ?>--tosql_farm_agent_staff_info" type="text" class="input-small timepicker3">
										<span class="add-on" style="width: 50px;"><i class="icon-time"></i> In</span>
									</div>
									<div class="input-append bootstrap-timepicker">
										<input value="<?php echo ${"info_staff".$staff."close"}; ?>" name="<?php echo "staff".$staff."close"; ?>--tosql_farm_agent_staff_info" type="text" class="input-small timepicker3">
										<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Out</span>
									</div>
								</div>
								<div class="form_row">
									<label class="field_name">Name: </label>
									<div class="field">
										<input value="<?php echo ${"info_staffname".$staff}; ?>" name="<?php echo "staffname".$staff; ?>--tosql_farm_agent_staff_info" type="text" class="">
									</div>
								</div>
								<div class="form_row">
									<label class="field_name">Position: </label>
									<div class="field">
										<input value="<?php echo ${"info_staffposition".$staff}; ?>" name="<?php echo "staffposition".$staff; ?>--tosql_farm_agent_staff_info" type="text" class="">
									</div>
								</div>
								<div class="form_row">
									<label class="field_name">Phone: </label>
									<div class="field">
										<input value="<?php echo formatPhone(${"info_staffphone".$staff}); ?>" name="<?php echo "staffphone".$staff; ?>--tosql_farm_agent_staff_info" type="text" class="mask-phone">
									</div>
								</div>
								<div class="form_row">
									<label class="field_name">Email: </label>
									<div class="field">
										<input value="<?php echo ${"info_staffemail".$staff}; ?>" name="<?php echo "staffemail".$staff; ?>--tosql_farm_agent_staff_info" type="text" class="email">
									</div>
								</div>			
								
					
								
								
							</div>
						</div>
					</div>
					
				<?php } //End Fetch staff members ?>
				
				</div>
				
				</form>
				<div class="form_row">
								<br>
								<a href="#" class="btn btn-block update_user_data" formid="stafflist" dorefresh="1"><i class="icon-share"></i> Update</a>
					</div>
			</div>
		</div>
	

	
		
	</div>
	
	<div class="span6">
			
		
	  <div class="well <?php echo $info_ui_color; ?>">
			<div class="well-header">
				<h5>Additional Notes for CSG Reps</h5>
			</div>
	 
			<div class="well-content no-search">
				<form id="addednotes">
				<textarea class="textarea wysihtml5-sandbox" name="livestatus--tosql_farm_agent_info" placeholder="Enter text..." style="width: 100%; height: 100px"><?php echo $info_livestatus;?></textarea>
				</form>
				<div class="form_row">
						<br>
						<a href="#" class="btn btn-block update_user_data" formid="addednotes"><i class="icon-share"></i> Update</a>
				</div>
			</div>
		</div>
	
	
	  <div class="well <?php echo $info_ui_color; ?> phone_comp">
			<div class="well-header">
				<h5>Hours of Operation</h5>
				<ul class="nav nav-tabs pull-right">
					<li>
						<a class="icon" title="Help" href="#" rel="popover" data-trigger="hover" data-placement="left" data-content="You can set your available office hours here.  If you are closed on any day, simply set the open and closed times equal to one another.  Ex. 8:00AM to 8:00AM">
							<i class="icon-help"></i>?</i>
						</a>
					</li>
				</ul>
			</div>
			
		 <div class="well-content">
			<form id="hoursofop">
			<table class="table">
			   <tbody>
					<tr>
						<td>M
						</td>
						<td>
							<div class="input-append bootstrap-timepicker">
								<input readonly class="input-small timepicker3" name="mopen--tosql_farm_agent_info" type="text" value="<?php echo $info_mopen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Open</span>
							</div>
							<br>
							<div class="input-append bootstrap-timepicker">										   
								<input readonly class="input-small timepicker3" name="mclose--tosql_farm_agent_info" type="text" value="<?php echo $info_mclose; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Close</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>T
						</td>
						<td>
							<div class="input-append bootstrap-timepicker">
								<input readonly class="input-small timepicker3" name="topen--tosql_farm_agent_info" type="text" value="<?php echo $info_topen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Open</span>
							</div>
							<br>
							<div class="input-append bootstrap-timepicker">										   
								<input readonly class="input-small timepicker3" name="tclose--tosql_farm_agent_info" type="text" value="<?php echo $info_tclose; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Close</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>W
						</td>
						<td>
							<div class="input-append bootstrap-timepicker">
								<input readonly class="input-small timepicker3" name="wopen--tosql_farm_agent_info" type="text" value="<?php echo $info_wopen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Open</span>
							</div>
							<br>
							<div class="input-append bootstrap-timepicker">										   
								<input readonly class="input-small timepicker3" name="wclose--tosql_farm_agent_info" type="text" value="<?php echo $info_wclose; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Close</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>R
						</td>
						<td>
							<div class="input-append bootstrap-timepicker">
								<input readonly class="input-small timepicker3" name="ropen--tosql_farm_agent_info" type="text" value="<?php echo $info_ropen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Open</span>
							</div>
							<br>
							<div class="input-append bootstrap-timepicker">										   
								<input readonly class="input-small timepicker3" name="rclose--tosql_farm_agent_info" type="text" value="<?php echo $info_rclose; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Close</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>F
						</td>
						<td>
							<div class="input-append bootstrap-timepicker">
								<input readonly class="input-small timepicker3" name="fopen--tosql_farm_agent_info" type="text" value="<?php echo $info_fopen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Open</span>
							</div>
							<br>
							<div class="input-append bootstrap-timepicker">										   
								<input readonly class="input-small timepicker3" name="fclose--tosql_farm_agent_info" type="text" value="<?php echo $info_fclose; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Close</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>S
						</td>
						<td>
							<div class="input-append bootstrap-timepicker">
								<input readonly class="input-small timepicker3" name="saopen--tosql_farm_agent_info" type="text" value="<?php echo $info_saopen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Open</span>
							</div>
							<br>
							<div class="input-append bootstrap-timepicker">										   
								<input readonly class="input-small timepicker3" name="saclose--tosql_farm_agent_info" type="text" value="<?php echo $info_saopen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Close</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>S
						</td>
						<td>
							<div class="input-append bootstrap-timepicker">
								<input readonly class="input-small timepicker3" name="suopen--tosql_farm_agent_info" type="text" value="<?php echo $info_suopen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Open</span>
							</div>
							<br>
							<div class="input-append bootstrap-timepicker">										   
								<input readonly class="input-small timepicker3" name="suclose--tosql_farm_agent_info" type="text" value="<?php echo $info_suopen; ?>"/>
								<span class="add-on" style="width: 50px;"><i class="icon-time"></i> Close</span>
							</div>
						</td>
					</tr>
			   </tbody>
			</table>
			</form>
			<div class="form_row">
						<br>
						<a href="#" class="btn btn-block update_user_data" formid="hoursofop"><i class="icon-share"></i> Update</a>
			</div>
		 </div>
	  </div>
	



	
	
	
	  <div class="well <?php echo $info_ui_color; ?> desk_comp">
			<div class="well-header">
				<h5>Hours of Operation</h5>
				<ul class="nav nav-tabs pull-right">
					<li>
						<a class="icon" title="Help" href="#" rel="popover" data-trigger="hover" data-placement="left" data-content="You can set your available office hours here.  If you are closed on any day, simply set the open and closed times equal to one another.  Ex. 8:00AM to 8:00AM">
							<i class="icon-question-sign"></i>
						</a>
					</li>
				</ul>
			</div>
		

		 <div class="well-content">
			<div class="">
				<form id="hoursofop2">
				<table class="table">
				   <thead>
						<tr>
						  <th> Days </th>
						  <th> Open </th>
						  <th> Close </th>
						</tr>
				   </thead>
				   <tbody>
						<tr>
							<td>Monday</td>
							<td>
								<div class="input-append bootstrap-timepicker">
									<input readonly class="input-small timepicker3" name="mopen--tosql_farm_agent_info" type="text" value="<?php echo $info_mopen; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
							<td>
								<div class="input-append bootstrap-timepicker">										   
									<input readonly class="input-small timepicker3" name="mclose--tosql_farm_agent_info" type="text" value="<?php echo $info_mclose; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td>Tuesday</td>
							<td>
								<div class="input-append bootstrap-timepicker">
									<input readonly class="input-small timepicker3" name="topen--tosql_farm_agent_info" type="text" value="<?php echo $info_topen; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
							<td>
								<div class="input-append bootstrap-timepicker">										   
									<input readonly class="input-small timepicker3" name="tclose--tosql_farm_agent_info" type="text" value="<?php echo $info_tclose; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td>Wednesday</td>
							<td>
								<div class="input-append bootstrap-timepicker">
									<input readonly class="input-small timepicker3" name="wopen--tosql_farm_agent_info" type="text" value="<?php echo $info_wopen; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
							<td>
								<div class="input-append bootstrap-timepicker">										   
									<input readonly class="input-small timepicker3" name="wclose--tosql_farm_agent_info" type="text" value="<?php echo $info_wclose; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td>Thursday</td>
							<td>
								<div class="input-append bootstrap-timepicker">
									<input readonly class="input-small timepicker3" name="ropen--tosql_farm_agent_info" type="text" value="<?php echo $info_ropen; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
							<td>
								<div class="input-append bootstrap-timepicker">										   
									<input readonly class="input-small timepicker3" name="rclose--tosql_farm_agent_info" type="text" value="<?php echo $info_rclose; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td>Friday</td>
							<td>
								<div class="input-append bootstrap-timepicker">
									<input readonly class="input-small timepicker3" name="fopen--tosql_farm_agent_info" type="text" value="<?php echo $info_fopen; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
							<td>
								<div class="input-append bootstrap-timepicker">										   
									<input readonly class="input-small timepicker3" name="fclose--tosql_farm_agent_info" type="text" value="<?php echo $info_fclose; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td>Saturday</td>
							<td>
								<div class="input-append bootstrap-timepicker">
									<input readonly class="input-small timepicker3" name="saopen--tosql_farm_agent_info" type="text" value="<?php echo $info_saopen; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
							<td>
								<div class="input-append bootstrap-timepicker">										   
									<input readonly class="input-small timepicker3" name="saclose--tosql_farm_agent_info" type="text" value="<?php echo $info_saclose; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td>Sunday</td>
							<td>
								<div class="input-append bootstrap-timepicker">
									<input readonly class="input-small timepicker3" name="suopen--tosql_farm_agent_info" type="text" value="<?php echo $info_suopen; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
							<td>
								<div class="input-append bootstrap-timepicker">										   
									<input readonly class="input-small timepicker3" name="suclose--tosql_farm_agent_info" type="text" value="<?php echo $info_suclose; ?>"/>
									<span class="add-on"><i class="icon-time"></i></span>
								</div>
							</td>
						</tr>
				   </tbody>
				</table>
				</form>
				<div class="form_row">
						<br>
						<a href="#" class="btn btn-block update_user_data" formid="hoursofop2"><i class="icon-share"></i> Update</a>
				</div>
			</div>
		</div>
	  </div>
	</div>		
</div>
				
<script src="js/jquery-1.10.2.js"></script>	
<script>
  
function phonelist(e, name) { //Funtion to append phone number values to routeback list in real time
	
	window[name] = e.value;

	var eval = e.value;	
	var evalinner = e.value.replace(/\D/g,'');	//Strip all except numeric

	if(eval) {

	$("#routeback_phones option[name='"+name+"']").html('<option value="'+evalinner+'" name="'+name+'">' + name + ": " +eval+'</option>');

	}
}; 


	
</script>
				