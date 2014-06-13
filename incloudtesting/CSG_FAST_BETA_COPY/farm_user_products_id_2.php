<div class="well <?php echo $info_ui_color; ?>">
	<div class="well-header">
		<h5>Fields required for FFR Outbound Services</h5>
	</div>

	<div class="well-content no-search"> 


		<form id="prodid2">
		<div class="form_row added_fields prod_id_2 prod_id_3">
		<label class="field_name align_right">Set my appts with</label>
			<div class="field">
				<div class="span8">
					<select id="ffr_where_to_set_appts" name="where_to_set_appts--tosql_products_ext" type="text" class="chosen">
						<option value="Agent" <?php if($info_where_to_set_appts=="Agent"){echo "selected";}?>>Myself</option>
						<?php for($staff = 1; $staff <= 6; $staff++){ if(${"info_staffname".$staff} == ""){ $nostaff =TRUE; } else {$nostaff=FALSE;}?>
						<?php if(!$nostaff){ ?><option value="<?php echo ${"info_staffname".$staff}; ?>" <?php if($info_where_to_set_appts==${"info_staffname".$staff}){echo "selected";}?>><?php echo ${"info_staffname".$staff}; ?></option><?php } else ?>

						<?php } ?>					
					</select>
				<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="With whom should we set your appts with?" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div> 
		<div class="form_row added_fields prod_id_2">
			<label class="field_name align_right">Max day appts</label>
			<div class="field">
				<div class="span8">
					<input class="mask-digits" type="text" name="max_day_appts--tosql_products_ext" value="<?php echo $info_max_day_appts; ?>"/>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="Please provide the max appointments you want in a day" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div>
		<div class="form_row added_fields prod_id_2">
			<label class="field_name align_right">Max week appts</label>
			<div class="field">
				<div class="span8">
					<input class="mask-digits" type="text" name="max_week_appts--tosql_products_ext" value="<?php echo $info_max_week_appts; ?>"/>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="Please provide the max appointments you want in a week" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div>													
		<div class="form_row added_fields prod_id_2 prod_id_3">
			<label class="field_name align_right">Primary Appt. Preference</label>
			<div class="field">
				<div class="span8">
					<select class="chosen" name="primary_appt_pref--tosql_products_ext">
						<option></option>
						<option value="In Office" <?php if($info_primary_appt_pref=="In Office"){ echo "selected"; }?>>In Office</option>
						<option value="Home Visits" <?php if($info_primary_appt_pref=="Home Visits"){ echo "selected"; }?>>Home Visits</option>
						<option value="Phone Appts" <?php if($info_primary_appt_pref=="Phone Appts"){ echo "selected"; }?>>Phone Appts</option>
					</select>
				</div>

			</div>
		</div> 
		<div class="form_row added_fields prod_id_2 prod_id_3">
			<label class="field_name align_right">Secondary Appt. Preference</label>
			<div class="field">
				<div class="span8">
					<select class="chosen" name="secondary_appt_pref--tosql_products_ext">
						<option></option>
						<option value="In Office" <?php if($info_secondary_appt_pref=="In Office"){ echo "selected"; }?>>In Office</option>
						<option value="Home Visits" <?php if($info_secondary_appt_pref=="Home Visits"){ echo "selected"; }?>>Home Visits</option>
						<option value="Phone Appts" <?php if($info_secondary_appt_pref=="Phone Appts"){ echo "selected"; }?>>Phone Appts</option>
					</select>
				</div>
				
			</div>
		</div> 
		<div class="form_row added_fields prod_id_2 prod_id_3">
			<label class="field_name align_right">Appt. length</label>
			<div class="field">
				<div class="span8">
					<select class="chosen" name="initial_phone_appt_length--tosql_products_ext">
						<option></option>
						<option value="15 minutes" <?php if($info_initial_phone_appt_length=="15 minutes"){ echo "selected"; }?>>15 minutes</option>
						<option value="30 minutes" <?php if($info_initial_phone_appt_length=="30 minutes"){ echo "selected"; }?>>30 minutes</option>
						<option value="60 minutes" <?php if($info_initial_phone_appt_length=="60 minutes"){ echo "selected"; }?>>60 minutes</option>
					</select>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="What length of time would you like your appts set for?" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div>
		<div class="form_row added_fields prod_id_2">
			<label class="field_name align_right">Appt. Seperation</label>
			<div class="field">
				<div class="span8">
					<select class="chosen" name="timeframe_between_appts--tosql_products_ext">
						<option></option>
						<option value="15 minutes" <?php if($info_timeframe_between_appts=="15 minutes"){ echo "selected"; }?>>15 minutes</option>
						<option value="30 minutes" <?php if($info_timeframe_between_appts=="30 minutes"){ echo "selected"; }?>>30 minutes</option>
						<option value="60 minutes" <?php if($info_timeframe_between_appts=="60 minutes"){ echo "selected"; }?>>60 minutes</option>
						<option value="90 minutes" <?php if($info_timeframe_between_appts=="90 minutes"){ echo "selected"; }?>>90 minutes</option>
						<option value="120 minutes" <?php if($info_timeframe_between_appts=="120 minutes"){ echo "selected"; }?>>120 minutes</option>
					</select>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="How long would you like in-between appts?" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div>
		<div class="form_row added_fields prod_id_2">
			<label class="field_name align_right">Appt. Range</label>
			<div class="field">
				<div class="span8">
					<select class="chosen" name="how_far_out_by_week--tosql_products_ext">
						<option></option>
						<option value="1 week out" <?php if($info_how_far_out_by_week=="1 week out"){ echo "selected"; }?>>1 week out</option>
						<option value="2 weeks out" <?php if($info_how_far_out_by_week=="2 weeks out"){ echo "selected"; }?>>2 weeks out</option>
						<option value="3 weeks out" <?php if($info_how_far_out_by_week=="3 weeks out"){ echo "selected"; }?>>3 weeks out</option>
					</select>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="How many weeks out do you want your appts scheduled?" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
			
		</div>
		<div class="form_row added_fields prod_id_2 prod_id_3">
			<label class="field_name align_right">Special Details</label>
			<div class="field">
				<div class="span8">
					<textarea class="autosize" name="special_details--tosql_products_ext" cols="63" rows="3" style="resize: vertical; height: 88px;"><?php echo $info_special_details; ?></textarea>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="Do you have any special details we need to be aware of?" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div>
		<div class="form_row added_fields prod_id_2">
			<label class="field_name align_right">Other Services</label>
			<div class="field">
				<div class="span8">
					 <textarea class="autosize" name="other_services_provided--tosql_products_ext" cols="63" rows="3" style="resize: vertical; height: 88px;"><?php echo $info_other_services_provided; ?></textarea>
					 <span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="What other services does your office provide?" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div>
		<div class="form_row added_fields prod_id_2">
			<label class="field_name align_right">Allow Eprint?</label>
			<div class="field">
				<div class="span8">
					<select class="chosen" name="send_eprint--tosql_products_ext">
						<option></option>
						<option value="Yes" <?php if($info_send_eprint=="Yes"){ echo "selected"; }?>>Yes</option>
						<option value="No" <?php if($info_send_eprint=="No"){ echo "selected"; }?>>No</option>
					</select>
					<span class="help"><a href="#" rel="popover" data-trigger="hover" data-placement="right" data-content="In the event there is incorrect contact info for one of your clients, would you like us to send an EPRINT letter on your behalf?" title="Help" class="btn orange">?</a></span>
				</div>
				
			</div>
		</div>

		<div class="form_row">
		<br>
		<a href="#" class="btn update_user_data btn-block" formid="prodid2"><i class="icon-share"></i> Update</a>
		</div>
	</div>
</div>