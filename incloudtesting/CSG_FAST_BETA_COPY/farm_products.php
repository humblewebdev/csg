<div class="row-fluid">
	<div class="span6">
	
		<div class="well <?php echo $info_ui_color; ?>">
			<div class="well-header">
				<h5>Products Signed Up for</h5>
			</div>

			<div class="well-content no-search">
				<div class="accordion" id="accordion2">
				<?php foreach($products_signedup as $psu){ ?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo "pi".$psu['product_id']; ?>">
								<?php echo "<h4><i class='icon-plus'></i> &nbsp;" . $psu['product_name'] ."</h4>"; ?>
							</a>
						</div>
						<div id="<?php echo "pi".$psu['product_id']; ?>" class="accordion-body collapse">
							<div class="accordion-inner">
								<?php echo "" . $psu['product_short_desc'] . ""; ?>
								<br><div class="btn red" style="float:right;" onclick="farm_user_update_prod(<?php echo $psu['product_id']; ?>, 'remove')"> <i class="icon-remove-circle"></i> Remove Product? </div><br><br>
							</div>
						</div>
					</div>
				<?php } //End Fetch for signed up products ?>
				</div>
				
			</div>
		</div>
	
		<div class="well <?php echo $info_ui_color; ?>">
			<div class="well-header">
				<h5>Other</h5>
			</div>

			<div class="well-content no-search">
				<div class="accordion" id="accordion2">
				<?php foreach($products_other as $po){ ?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo "po".$po['product_id']; ?>">
								<?php echo "<h4><i class='icon-plus'></i> &nbsp;" . $po['product_name'] ."</h4>"; ?>
							</a>
						</div>
						<div id="<?php echo "po".$po['product_id']; ?>" class="accordion-body collapse">
							<div class="accordion-inner">
								<?php echo "" . $po['product_short_desc'] . ""; ?>
								<br><div class="btn green" style="float:right;" onclick="farm_user_update_prod(<?php echo $po['product_id']; ?>, 'add')"> <i class="icon-plus-sign"></i> Add Product? </div><br><br>
							</div>
						</div>
					</div>
				<?php } //End Fetch for signed up products ?>
				</div>
				
			</div>
		</div>
	
		
	</div>
		

    <div class="span6">

		<div class="well <?php echo $info_ui_color; ?>">
			<div class="well-header">
				<h5>Products Approved</h5>
			</div>

			<div class="well-content no-search">
				<?php
					foreach($products_approved as $pa){
						echo "<h4><i class='icon-ok-sign' style='color: green;'></i> " . $pa['product_name'] . "</h4><br>";
					}
				?>
			</div>
		</div>
	
		<div class="well <?php echo $info_ui_color; ?>">
			<div class="well-header">
				<h5>Products Pending Approval</h5>
			</div>

			<div class="well-content no-search">
				<?php
					foreach($products_pending as $pp){
						echo "<h4><i class='icon-time' style='color: red;'></i> " . $pp['product_name'] . "</h4><br>";
					}
				?>
			</div>
		</div>
	</div>
	
	

<script src="js/jquery-1.10.2.js"></script>
<script>

function farm_user_update_prod(id, option){

if(option == "remove"){

    if (confirm('Are you sure you wish to remove this product from your account?')) {
	var currentprods = '<?php echo $info_fast_products; ?>';
	var cprodarry = currentprods.split('#');

	cprodarry = jQuery.grep(cprodarry, function(value) {
	  return value != id;
	})

	var newstring = cprodarry.toString();
	var readystring = newstring.replace(/\,/g, '#');

	//alert("The new String after " +id+" is removed is " + readystring);
	
	var sendData = "users_id=<?php echo $info_users_id; ?>&fast_products--tosql_farm_agent_info="+readystring;
	
	$.ajax({
		type: 'POST',
		url: 'z_scripts/farm_user_agent_update.php?type=submit',
		data: sendData,
		success: function(data, textStatus, jqXHR){
			//alert(data);
			location.reload();
		}
	});
	}
	
	
}

if(option == "add"){

    if (confirm('Are you sure you wish to request this product be added to your account?')) {
	var currentprods = '<?php echo $info_fast_products; ?>';
	var cprodarry = currentprods.split('#');
	
	cprodarry.push(id);

	var newstring = cprodarry.toString();
	var readystring = newstring.replace(/\,/g, '#');

	//alert("The new String after " +id+" is added is " + readystring);
	
	var sendData = "users_id=<?php echo $info_users_id; ?>&fast_products--tosql_farm_agent_info="+readystring;
	
	$.ajax({
		type: 'POST',
		url: 'z_scripts/farm_user_agent_update.php?type=submit',
		data: sendData,
		success: function(data, textStatus, jqXHR){
			//alert(data);
			location.reload();
		}
	});
	
	}
	
}


}
</script>