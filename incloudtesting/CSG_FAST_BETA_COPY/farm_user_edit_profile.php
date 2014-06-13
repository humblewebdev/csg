
<div class="row-fluid">
	<div class="span6">
	
	    <div class="well <?php echo $info_ui_color; ?>">	
				<div class="well-header">
					<h5>Edit Profile</h5>
				</div>		
				<div class="well-content no-search">
				
				<?php if($_GET['picstatus'] != NULL && $_GET['picstatus'] == "success"){ ?>
				<div class="alert alert-success text-center">
							<i class="icon-ok-circle"></i>
							<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button> Your profile picture has been successfully updated!
							<br>Filename: <?php echo $_GET['filename']; ?>
							<br>Size: <?php echo round($_GET['size'], 2) . " kB"; ?>
							<br><a href="#" class="picrefresh">Click Here to Refresh the page if your new image isn't displayed automatically</a>
				</div>
				<?php } else if($_GET['picstatus'] != NULL && $_GET['picstatus'] == "error_noneselected"){ ?>
				<div class="alert alert-error">
							<i class="icon-cancel"></i>
							<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button> A replacement image was not selected! 
				</div>
				<?php } ?>
				
				<form id="editprof3" enctype="multipart/form-data" name="editprof3" method="post" action="z_scripts/farm_user_agent_update.php?type=submit_photo">
				<div class="form_row">
					<div class="field">
					<a href="#" class="btn update_user_pic" formid="editprof3" dorefresh="1">Use FarmersAgent.com Image?</a>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="By clicking this button, we will set the profile image that you have set on your http://farmersagent.com website as your profile image for this website " title="Help" class="btn orange">?</a></span>
					</div><br>
					<label class="field_name align_right">Upload your image</label>
					<div class="field">
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="profile_pics/<?php echo $info_profile_pic; ?>" onError="this.src='http://farmersagent.com/Images/FarmersLogo_placements.jpg';"/></div>
						  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						  <div>
							<span class="btn btn-file">
								<span class="fileupload-new">Select image</span>
								<span class="fileupload-exists">Change</span>
								<input type="file" name="file" id="fileToUpload"/>
							</span>
							<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
						  </div>
						  
						</div>
						<input type="text" name="firstname" value="<?php echo $info_firstname; ?>" style="display: none;"/>
						<input type="text" name="lastname" value="<?php echo $info_lastname; ?>" style="display: none;"/>
						<input type="text" name="web" value="<?php echo $info_website; ?>" style="display: none;"/>
						<input type="text" name="uid" value="<?php echo $info_users_id; ?>" style="display: none;"/><br>
						
					</div>
				</div>
				<div class="form_row">

						<button class="btn btn-block update_user_loading" type="submit" ><i class="icon-share"></i> Update</button>
				</div>
				
			</form>
			</div>
	    </div>
	    
		<div class="well <?php echo $info_ui_color; ?>">
			<div class="well-header">
				<h5>Edit Profile</h5>
			</div>

			<div class="well-content no-search">
			<form id="editprof1">
				<div class="form_row control-group error">
					<label class="field_name">Agent Name: </label>
					<div class="field">
						<span class="field_value"><?php echo $info_firstname . " " . $info_lastname; ?></span>
					</div>
				</div>
				<div class="form_row control-group error">
					<label class="field_name">Agency Name: </label>
					<div class="field">
						<span class="field_value"><?php echo $info_agencyname; ?></span>
					</div>
				</div>
				<div class="form_row control-group error">
					<label class="field_name">Reg. Date: </label>
					<div class="field">
						<span class="field_value"><?php echo $info_reg_date; ?></span>
					</div>
				</div>
				<div class="form_row control-group error">
					<label class="field_name">Agent Code: </label>
					<div class="field">
						<span class="field_value"><?php echo $info_agent_code; ?></span>
					</div>
				</div>
				<div class="form_row">
					<label class="field_name">Spanish Speaking: </label>
					<div class="field">
						<label class="radio">
							<input type="radio" class="uniform" name="spanish--tosql_farm_agent_info" value="Yes" <?php if($info_spanish=="Yes"){echo "checked";} ?>> Yes
						</label>
						<label class="radio">
							<input type="radio" class="uniform" name="spanish--tosql_farm_agent_info" value="No" <?php if($info_spanish=="No"){echo "checked";} ?>> No
						</label>
					</div>
				</div>
				
				</form>
				<div class="form_row">
						<br>
						<a href="#" class="btn btn-block update_user_data" formid="editprof1"><i class="icon-share"></i> Update</a>
				</div>
			</div>
		</div>
	</div>

		<div class="span6">			
		    		
			<div class="well <?php echo $info_ui_color; ?>">	
				<div class="well-header">
					<h5>Edit Profile</h5>
				</div>		
				<div class="well-content no-search">
				<form id="editprof2">

				<div class="form_row">
					<label class="field_name align_right">Username</label>
					<div class="field">
						<span class="usernamemirror_text"><?php echo $info_username; ?></span>
					</div>
				</div>
				<div class="form_row">
					<label class="field_name align_right">Email <span class="required">*</span></label>
					<div class="field">
						<input class="span8 required email" id="usernamemirror" type="text" value="<?php echo $info_email; ?>" name="email--tosql_users">
						<input class="span8 required email usernamemirror" type="text" value="<?php echo $info_username; ?>" name="username--tosql_users" style="display: none;">
					</div>
				</div>
				<div class="form_row">
					<label class="field_name align_right">Address <span class="required">*</span></label>
					<div class="field">
						<input class="span8 requiredmin" type="text" value="<?php echo $info_address; ?>" name="address--tosql_farm_agent_info">
					</div>
				</div>
				<div class="form_row">
					<label class="field_name align_right">City <span class="required">*</span></label>
					<div class="field">
						<input class="span8 requiredmin" type="text" value="<?php echo $info_city; ?>" name="city--tosql_farm_agent_info">
					</div>
				</div>
				<div class="form_row">
					<label class="field_name align_right">Zip / Postal Code</label>
					<div class="field">
						<input class="span8 required zip" type="text" value="<?php echo $info_zipcode; ?>" name="zipcode--tosql_farm_agent_info">
					</div>
				</div>
				<div class="form_row">
					<label class="field_name align_right">County</label>
					<div class="field">
						<input class="span8 requiredmin" type="text" value="<?php echo $info_county; ?>" name="county--tosql_farm_agent_info">
					</div>
				</div>
				<div class="form_row">
						<label class="field_name align_right">District Manager</label>
						<div class="field">
							<div class="span4">
								<select class="chosen required" name="dm_id--tosql_farm_agent_info">
								    <?php 
									$dm_req1 = "SELECT * from dm_list WHERE id_dm = '$info_dm_id' LIMIT 1;";
									$dm_query1 = $mysqli->query($dm_req1)or die($mysqli->error); 
									$dm_row1 = $dm_query1->fetch_assoc();
									$dmname = $dm_row1['firstname'] . " " . $dm_row1['lastname'] . " | " . $dm_row1['state_office'];
										
									?>
									<option value="<?php echo $info_dm_id; ?>"><?php echo $dmname; ?></option>
									<?php
									$dm_req2 = "SELECT * from dm_list;";
									$dm_query2 = $mysqli->query($dm_req2)or die($mysqli->error); 

										while($dm_row2 = $dm_query2->fetch_assoc())
										{
										  echo "<option value='{$dm_row2['id_dm']}' >{$dm_row2['firstname']} {$dm_row2['lastname']} | {$dm_row2['state_office']}</option>";
										} $mysqli->close();
									?>
								 </select>
							</div>
						</div>
					</div> 
				<div class="form_row">
					<label class="field_name align_right">Appt. Preference</label>
					<div class="field">
						<div class="span4 no-search">
							<select class="chosen" name="appts--tosql_farm_agent_info">
							    <option><?php echo $info_appts; ?></option>
								<option>In Office</option>
								<option>Home Visits</option>
								<option>Phone Appts.</option>
								<option>All of the above</option>
								<option>Phone Appts. & In Office Only</option>
								<option>In Office & Home Visits Only</option>
								<option>Phone Appts. & Home Visits Only</option>
							</select>
						</div>
					</div>
				</div>
				
				</form>
				<div class="form_row">
						<br>
						<a href="#" class="btn btn-block update_user_data" formid="editprof2"><i class="icon-share"></i> Update</a>
				</div>
			</div>
		</div>
		
		
		
		
	</div>
</div>
				
				

         
			
			
			
