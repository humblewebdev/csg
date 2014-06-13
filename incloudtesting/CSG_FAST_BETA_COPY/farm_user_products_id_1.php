<?php $callchoice = explode('#', $info_calltypes_notes);?>
<?php $callchoice2 = explode('#', $info_calltypes_notes2);?>

		<h4>Fields required for Inbound Services</h4>


	    <form id="prodid1">
		
		
		<div class="row-fluid">
			<div class="well span6 <?php echo $info_ui_color; ?>">
				<div class="well-header">
					<h5>Call Routing</h5>
				</div>
				<div class="well-content no-search"> 
				<table class="table table-hover">
				   <thead>
					  <tr>
						 <th>Farmers</th>
						 <th>My Office</th>
						 <th>Call Types</th>
					  </tr>
				   </thead>
				   <tbody>
						<tr>
							<td align="center"><input type="radio" class="uniform cn0 calltypes" name="cn0" value="0_seamless" <?php if($info_calltypes_notes == NULL || $callchoice[0] == '0_seamless'){echo "checked";} ?>/></td>
							<td align="center"><input type="radio" class="uniform cn0 calltypes" name="cn0" value="0_office" <?php if($callchoice[0] == '0_office'){echo "checked";} ?>/></td>
							<td>Cancellations</td>
						</tr>
						<tr>
							<td align="center"><input type="radio" class="uniform cn1 calltypes" name="cn1" value="1_seamless" <?php if($info_calltypes_notes == NULL || $callchoice[1] == '1_seamless'){echo "checked";} ?>/></td>
							<td align="center"><input type="radio" class="uniform cn1 calltypes" name="cn1" value="1_office" <?php if($callchoice[1] == '1_office'){echo "checked";} ?>/></td>
							<td>Coverage Changes</td>
						</tr>
						<tr>
							<td align="center"><input type="radio" class="uniform cn2 calltypes" name="cn2" value="2_seamless" <?php if($info_calltypes_notes == NULL || $callchoice[2] == '2_seamless'){echo "checked";} ?>/></td>
							<td align="center"><input type="radio" class="uniform cn2 calltypes" name="cn2" value="2_office" <?php if($callchoice[2] == '2_office'){echo "checked";} ?>/></td>
							<td>Claims</td>
						</tr>
						<tr>
							<td align="center"><input type="radio" class="uniform cn3 calltypes" name="cn3" value="3_seamless" <?php if($info_calltypes_notes == NULL || $callchoice[3] == '3_seamless'){echo "checked";} ?>/></td>
							<td align="center"><input type="radio" class="uniform cn3 calltypes" name="cn3" value="3_office" <?php if($callchoice[3] == '3_office'){echo "checked";} ?>/></td>
							<td>New Business</td>
						</tr>
				   </tbody>
				</table>
				<div class="form_row">
				<br>
				<a href="#" class="btn update_user_data btn-block" formid="prodid1"><i class="icon-share"></i> Update</a>
				</div>
				</div>
			</div>
			
			<div class="well span6 <?php echo $info_ui_color; ?>">
				<div class="well-header">
					<h5>After Hours</h5>
				</div>
				<div class="well-content no-search"> 
				<table class="table table-hover">
				   <thead>
					  <tr>
						 <th>Farmers</th>
						 <th>My Office</th>
						 <th>Call Types</th>
					  </tr>
				   </thead>
				   <tbody>
						<tr>
							<td align="center"><input type="radio" name="cnao0" class="cnao0 uniform calltypes" value="0_seamless" <?php if($info_calltypes_notes2 == NULL || $callchoice2[0] == '0_seamless'){echo "checked";} ?> /></td>
							<td align="center"><input type="radio" name="cnao0" class="cnao0 uniform calltypes" value="0_office" <?php if($callchoice2[0] == '0_office'){echo "checked";} ?> /></td>
							<td>Cancellations</td>
						</tr>
						<tr>
							<td align="center"><input type="radio" name="cnao1" class="cnao1 uniform calltypes" value="1_seamless" <?php if($info_calltypes_notes2 == NULL || $callchoice2[1] == '1_seamless'){echo "checked";} ?> /></td>
							<td align="center"><input type="radio" name="cnao1" class="cnao1 uniform calltypes" value="1_office" <?php if($callchoice2[1] == '1_office'){echo "checked";} ?> /></td>
							<td>Coverage Changes</td>
						</tr>
						<tr>
							<td align="center"><input type="radio" name="cnao2" class="cnao2 uniform calltypes" value="2_seamless" <?php if($info_calltypes_notes2 == NULL || $callchoice2[2] == '2_seamless'){echo "checked";} ?> /></td>
							<td align="center"><input type="radio" name="cnao2" class="cnao2 uniform calltypes" value="2_office" <?php if($callchoice2[2] == '2_office'){echo "checked";} ?> /></td>
							<td>Claims</td>
						</tr>
						<tr>
							<td align="center"><input type="radio" name="cnao3" class="cnao3 uniform calltypes" value="3_seamless" <?php if($info_calltypes_notes2 == NULL || $callchoice2[3] == '3_seamless'){echo "checked";} ?> /></td>
							<td align="center"><input type="radio" name="cnao3" class="cnao3 uniform calltypes" value="3_office" <?php if($callchoice2[3] == '3_office'){echo "checked";} ?> /></td>
							<td>New Business</td>
						</tr>
				   </tbody>
				</table>
				<div class="form_row">
				<br>
				<a href="#" class="btn update_user_data btn-block" formid="prodid1"><i class="icon-share"></i> Update</a>
				</div>
				</div>
			</div>
		</div>
		<input name="calltypes_notes--tosql_products_ext" type="text" id="calltypes" style="display: none;"/>
		<input name="calltypes_notes2--tosql_products_ext" type="text" id="calltypes2" style="display: none;"/>
		</form>
		

<script src="js/jquery-1.10.2.js"></script>		
<script>
$('.calltypes').on('change', function(){
    
	var calltypes = $('input[name=cn0]:checked', '#prodid1').val() + "#" + $('input[name=cn1]:checked', '#prodid1').val() + "#" + $('input[name=cn2]:checked', '#prodid1').val() + "#" + $('input[name=cn3]:checked', '#prodid1').val();
	var calltypes2 = $('input[name=cnao0]:checked', '#prodid1').val() + "#" + $('input[name=cnao1]:checked', '#prodid1').val() + "#" + $('input[name=cnao2]:checked', '#prodid1').val() + "#" + $('input[name=cnao3]:checked', '#prodid1').val();

	$("#calltypes").val(calltypes);
	$("#calltypes2").val(calltypes2);

});

$(document).ready(function(){
    
	var calltypes = $('input[name=cn0]:checked', '#prodid1').val() + "#" + $('input[name=cn1]:checked', '#prodid1').val() + "#" + $('input[name=cn2]:checked', '#prodid1').val() + "#" + $('input[name=cn3]:checked', '#prodid1').val();
	var calltypes2 = $('input[name=cnao0]:checked', '#prodid1').val() + "#" + $('input[name=cnao1]:checked', '#prodid1').val() + "#" + $('input[name=cnao2]:checked', '#prodid1').val() + "#" + $('input[name=cnao3]:checked', '#prodid1').val();

	$("#calltypes").val(calltypes);
	$("#calltypes2").val(calltypes2);

});
</script>
 
