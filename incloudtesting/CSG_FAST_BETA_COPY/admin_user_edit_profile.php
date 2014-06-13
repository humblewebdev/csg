
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
				<div class="form_row control-group">
					<label class="field_name">Admin Name: </label>
					<div class="field">
						<span class="field_value"><?php echo $info_firstname . " " . $info_lastname; ?></span>
					</div>
				</div>
				<div class="form_row control-group">
					<label class="field_name">First Name: </label>
					<div class="field">
						<input class="span8 required" type="text" name="firstname--tosql_users" value="<?php echo $info_firstname; ?>">
					</div>
				</div>
				<div class="form_row control-group">
					<label class="field_name">Last Name: </label>
					<div class="field">
						<input class="span8 required" type="text" name="lastname--tosql_users" value="<?php echo $info_lastname; ?>">
					</div>
				</div>
				</form>
				<div class="form_row">
						<br>
						<a href="#" class="btn btn-block update_user_data" formid="editprof1" dorefresh="1"><i class="icon-share"></i> Update</a>
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
				

				</form>
				<div class="form_row">
						<br>
						<a href="#" class="btn btn-block update_user_data" formid="editprof2"><i class="icon-share"></i> Update</a>
				</div>
			</div>
		</div>
		
		
		
		
	</div>
</div>
<script>

</script>
				
				

         
			
			
			
