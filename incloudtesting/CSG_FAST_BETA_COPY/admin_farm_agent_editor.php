<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include 'z_scripts/db_connect.php';
page_protect();
checkAdmin('logout');

$uid = $_GET['uid'];

$search_farm_users = $mysqli->query("SELECT * FROM users t
                              LEFT JOIN farm_agent_info t1
							  ON t.users_id = t1.users_id
							  LEFT JOIN farm_agent_staff_info t2
							  ON t.users_id = t2.users_id
							  LEFT JOIN farm_agent_staff_info t3
							  ON t.users_id = t3.users_id
							  LEFT JOIN farm_incontact_info t4
							  ON t.users_id = t4.users_id
							  LEFT JOIN products_ext t5
							  ON t.users_id = t5.users_id WHERE t.users_id='$uid';");

$thisuser = array(); // Associative array of all farmers users
$idfarm = 1;

while ($finfo = $search_farm_users->fetch_assoc()) {
  $thisuser[$idfarm] = $finfo; 
  $idfarm++;
}

$currentuser = $thisuser[1];

$productids = explode("#", $currentuser['fast_products']);
$productids_appr = explode("#", $currentuser['fast_products_approved']);

$qproducts_all = $mysqli->query("SELECT * FROM fast_products;") or die($mysqli->error);
$qproducts = $mysqli->query("SELECT * FROM fast_products WHERE product_id IN ('" . implode("','", $productids) . "');") or die($mysqli->error);
$qproducts_pend = $mysqli->query("SELECT * FROM fast_products WHERE product_id NOT IN ('" . implode("','", $productids_appr) . "') AND product_id IN ('" . implode("','", $productids) . "');") or die($mysqli->error);
$qproducts_appr = $mysqli->query("SELECT * FROM fast_products WHERE product_id IN ('" . implode("','", $productids_appr) . "') AND product_id IN ('" . implode("','", $productids) . "');") or die($mysqli->error);
$qproducts_oth = $mysqli->query("SELECT * FROM fast_products WHERE product_id NOT IN ('" . implode("','", $productids) . "');") or die($mysqli->error);

$products_all = array(); //Associative array of signed up items
$products_signedup = array(); //Associative array of signed up items
$products_pending = array(); //Associative array of pending items
$products_approved = array(); //Associative array of approved items
$products_other = array(); // Associative array of items not yet signed up for

//Build Associative arrays that can be used throughout the program
$idpinfo = 1;
$idpinfop = 1;
$idpinfoa = 1;
$idpinfoo = 1;
$idpall = 1;
while ($pinfo = $qproducts->fetch_assoc()) {
  $products_signedup[$idpinfo] = $pinfo; 
  $idpinfo++;
}

while ($pinfop = $qproducts_pend->fetch_assoc()) {
  $products_pending[$idpinfop] = $pinfop; 
  $idpinfop++;
}

while ($pinfoa = $qproducts_appr->fetch_assoc()) {
  $products_approved[$idpinfoa] = $pinfoa; 
  $idpinfoa++;
}

while ($pinfoo = $qproducts_oth->fetch_assoc()) {
  $products_other[$idpinfoo] = $pinfoo; 
  $idpinfoo++;
}

while ($pall = $qproducts_all->fetch_assoc()) {
  $products_all[$idpall] = $pall; 
  $idpall++;
}
?>


<div class="row-fluid">
	<div class="span3">
		<div class="user_image">
			<center><img src="profile_pics/<?php echo $currentuser['profile_pic']; ?>" alt=""></center>
			<a href="#" class="overlay"></a>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<a href="#" class="btn btn-block grey"><i class="icon-envelope"></i> Send message</a>
			</div>
			<div class="span6">
				<a href="#" class="btn btn-block blue"><i class="icon-plus"></i> Add Notes</a>
			</div>
		</div><br>
		<div class="row-fluid">
			<div class="span4">
				<a href="#" class="btn btn-block yellow">View Notes</a>
			</div>
			<div class="span4">
				<a href="#" class="btn btn-block yellow">View Emails</a>
			</div>
			<div class="span4">
				<a href="#" class="btn btn-block yellow">Logins</a>
			</div>
		</div>
		<div class="friend_list">
		    <div class="well well-head">
				<div class="well-content well-head">
					<h5>Login Status <?php if($currentuser['approved'] == '0' && $currentuser['banned'] != '1'){echo "<span style='float: right;' class='label label-warning'>Pending.."; } 
								     else if($currentuser['approved'] == '1' && $currentuser['banned'] != '1'){echo "<span style='float: right;' class='label label-success'>Approved"; } 
									 else if($currentuser['banned'] == '1'){echo "<span style='float: right;' class='label label-alert'>Locked"; } ?></span></h5>
				</div>
			</div>
			
			<br>
			
			<div class="well well-head">
				<div class="well-content well-head">
					<h5>Products Signed Up for</h5>
				</div>
			</div>
			<ul>
			<?php foreach($products_signedup as $psu){ 
            
			echo "<li><h5>" . $psu['product_name'] . "</h5></li>";
			
			
			}?>
			</ul>
			<br>
			<div class="well well-head">
				<div class="well-content well-head">
					<h5>Products Pending Approval</h5>
				</div>
			</div>
			<ul>
			<?php foreach($products_pending as $pp){ 
            
			echo "<li><h5>" . $pp['product_name'] . "</h5></li>";
			
			
			}?>
			</ul>
		</div>
	</div>
	<div class="span4">
		<div class="well well-head">
			<div class="well-content well-head">
				<h5>Agent Info</h5>
			</div>
		</div>
		<table class="table">
			<tbody>
				<tr>
					<td>Name</td>
					<td><?php echo $currentuser['firstname'] . " " . $currentuser['lastname']; ?></td>
				</tr>
				<tr>
					<td>Agent Code</td>
					<td><?php echo $currentuser['agent_code']; ?></td>
				</tr>
				<tr>
					<td>Agency Name</td>
					<td><?php echo $currentuser['agencyname']; ?></td>
				</tr>
				<tr>
					<td>City</td>
					<td><?php echo $currentuser['city']; ?></td>
				</tr>
				<tr>
					<td>County</td>
					<td><?php echo $currentuser['county']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $currentuser['email']; ?></td>
				</tr>
				<tr>
					<td>Main Phone</td>
					<td><?php echo formatPhone($currentuser['mainphone']); ?></td>
				</tr>
				<tr>
					<td>Second Phone</td>
					<td><?php echo formatPhone($currentuser['secondphone']); ?></td>
				</tr>
				<tr>
					<td>Cell Phone</td>
					<td><?php echo formatPhone($currentuser['cellphone']); ?></td>
				</tr>
				<tr>
					<td>Web</td>
					<td><a href="<?php echo $currentuser['website']; ?>" target="_blank" class="label"><i class="icon-globe"></i> Farmers Agent Web Page</a></td>
				</tr>
				<tr>
					<td>Live Status</td>
					<td><?php echo $currentuser['livestatus']; ?></td>
				</tr>
			</tbody>
		</table>
		<br>
	</div>
	<div class="span5">
		<div class="navbar-inner">
			<ul class="nav nav-tabs">
			    <li><a href="#ainfo" data-toggle="tab">Agency Info</a></li>
				<li><a href="#astaff" data-toggle="tab">Agency Staff</a></li>
				<li class="active"><a href="#padmin" data-toggle="tab">Product Admin</a></li>
				<li><a href="#prodext" data-toggle="tab">Product Ext.</a></li>
			</ul>
		</div>
		<div class="tab-content">
		
		    <div class="tab-pane no_padding" id="ainfo">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Pif Size</td>
							<td><?php echo $currentuser['pif']; ?></td>
						</tr>
						<tr>
							<td>Years In Business</td>
							<td><?php echo $currentuser['years_in_bus']; ?></td>
						</tr>
						<tr>
							<td>Appt. Preference</td>
							<td><?php echo $currentuser['appts']; ?></td>
						</tr>
						<tr>
							<td>Using ECMS?</td>
							<td><?php echo $currentuser['ecmscalender']; ?></td>
						</tr>
						<tr>
							<td>Forwarding Lines Capable?</td>
							<td><?php echo $currentuser['forwardinglines']; ?></td>
						</tr>
						<tr>
							<td>Spanish?</td>
							<td><?php echo $currentuser['spanish']; ?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><strong>Hours of Operation</strong></td>
							<td>&nbsp;</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-striped table-hover">
					<tr>
						<td>Monday</td>
						<td><?php Print "".$currentuser['mopen']  . " ";   ?></td>
						<td>to</td>
						<td><?php Print "".$currentuser['mclose']  . " ";   ?></td>
					</tr>
					<tr>
						<td>Tuesday</td>
						<td><?php Print "".$currentuser['topen']  . " ";   ?></td>
						<td>to</td>
						<td><?php Print "".$currentuser['tclose']  . " ";   ?></td>
					</tr>
					<tr>
						<td>Wednesday</td>
						<td><?php Print "".$currentuser['wopen']  . " ";   ?></td>
						<td>to</td>
						<td><?php Print "".$currentuser['wclose']  . " ";   ?></td>
					</tr>
					<tr>
						<td>Thursday</td>
						<td><?php Print "".$currentuser['ropen']  . " ";   ?></td>
						<td>to</td>
						<td><?php Print "".$currentuser['rclose']  . " ";   ?></td>
					</tr>
					<tr>
						<td>Friday</td>
						<td><?php Print "".$currentuser['fopen']  . " ";   ?></td>
						<td>to</td>
						<td><?php Print "".$currentuser['fclose']  . " ";   ?></td>
					</tr>
					<tr>
						<td>Saturday</td>
						<td><?php if($currentuser['saopen'] == $currentuser['saclose']){ echo "Closed"; } else{ Print "".$currentuser['saopen']  . " ";  } ?></td>
						<td>to</td>
						<td><?php if($currentuser['saopen'] == $currentuser['saclose']){ echo "Closed"; } else{ Print "".$currentuser['saclose']  . " ";  } ?></td>
					</tr>
					<tr>
						<td>Sunday</td>
						<td><?php if($currentuser['suopen'] == $currentuser['suclose']){ echo "Closed"; } else{ Print "".$currentuser['suopen']  . " ";  } ?></td>
						<td>to</td>
						<td><?php if($currentuser['suopen'] == $currentuser['suclose']){ echo "Closed"; } else{ Print "".$currentuser['suopen']  . " ";  } ?></td>
					</tr>
					
			</table>
			</div>
		    
			<div class="tab-pane no_padding" id="astaff">
			  <table class="table table-striped">
			    <thead>
				<tr><th>&nbsp;</th><th>&nbsp;</th></tr>
				</thead>
				<tbody>
				<?php for($istaff = 1; $istaff <=6; $istaff++){ if($currentuser["staffname$istaff"] != ""){?>
						<?php if($currentuser["staffname$istaff"] != NULL){ ?><tr><td><strong>Name <?php echo $istaff; ?>: </strong></td><td><?php Print "".$currentuser["staffname$istaff"]  . " ";   ?></td></tr><?php } ?>
						<?php if($currentuser["staffposition$istaff"] != NULL){ ?><tr><td>Position: </td><td><?php Print "".$currentuser["staffposition$istaff"]  . " ";   ?></td></tr><?php } ?>
						<?php if($currentuser["staffphone$istaff"] != NULL){ ?><tr><td>Phone: </td><td><?php Print "".formatPhone($currentuser["staffphone$istaff"])  . " ";   ?></td></tr><?php } ?>
						<?php if($currentuser["staffemail$istaff"] != NULL){ ?><tr><td>Email: </td><td><?php Print "".$currentuser["staffemail$istaff"]  . " ";   ?></td></tr><?php } ?>
				<?php }} ?>
				</tbody>
			 </table>
			</div>
			
			<div class="tab-pane no_padding active" id="padmin">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Status</th>
							<th>Product Name</th>
							<th>Action</th>
						</tr>				
					</thead>
					<tbody>
					<?php foreach($products_all as $pall){ 
                    if(in_array($pall['product_id'], $productids_appr)){ $p_status = "<span class='label label-success'>Approved</span>"; } else { $p_status = "<span class='label label-warning'>Not Approved</span>"; }
					echo "<tr><td>" . $pall['product_id'] . "</td>
						  <td>$p_status</td>
						  <td>" . $pall['product_name'] . "</td>
						  <td><div class='dropdown'>
                              <a href='#' data-toggle='dropdown' class='btn'><i class='icon-list-alt'></i> <span class='caret'></span></a>
                                <ul class='dropdown-menu'>
                                    <li class='productupdate_ajax' myaction='approve' doreload='1' prodid='" . $pall['product_id'] . "'><a href='#'>Approve</a></li>
                                    <li class='productupdate_ajax' myaction='remove' doreload='1' prodid='" . $pall['product_id'] . "'><a href='#'>Un-Approve</a></li>
                                </ul>
                              </div>
						   </td>
						   </tr>";
					
					}?>	
					</tbody>
				</table>
			</div>
			
			<div class="tab-pane no_padding" id="prodext">
				<table class="table table-striped table-hover">
				    <thead>
					<tr><th>&nbsp;</th><th>&nbsp;</th></tr>
					</thead>
					<tbody>
					<tr><td><strong>Time in-between Appts:</strong></td><td style="text-align: right;"><?php echo $currentuser['timeframe_between_appts'] ; ?></td></tr>
					<tr><td><strong>Max in Day:</strong></td><td style="text-align: right;"><?php echo $currentuser['max_day_appts'] ; ?></td></tr>
					<tr><td><strong>Max in Week:</strong></td><td style="text-align: right;"><?php echo $currentuser['max_week_appts'] ; ?></td></tr>
					<tr><td><strong>Travel Capable:</strong></td><td style="text-align: right;"><?php echo $currentuser['travel_capable'] ; ?></td></tr>
					<tr><td><strong>How far out Appts. set:</strong></td><td style="text-align: right;"><?php echo $currentuser['how_far_out_by_week']  . " weeks"; ?></td></tr>
					<tr><td><strong>Send EPrints on behalf of agent?</strong></td><td style="text-align: right;"><?php echo $currentuser['send_eprint'] ; ?></td></tr>
					<tr><td><strong>Appts. are set with:</strong></td><td style="text-align: right;"><?php echo $currentuser['where_to_set_appts'] ; ?></td></tr>
					<tr><td><strong>1st Appt. Preference:</strong></td><td style="text-align: right;"><?php echo $currentuser['primary_appt_pref'] ; ?></td></tr>
					<tr><td><strong>2nd Appt. Preference:</strong></td><td style="text-align: right;"><?php echo $currentuser['secondary_appt_pref'] ; ?></td></tr>
					<tr><td><strong>Length of Appts:</strong></td><td style="text-align: right;"><?php echo $currentuser['initial_phone_appt_length'] ; ?></td></tr>
					<tr><td><strong>Special Notes:</strong></td><td style="text-align: right;"><?php echo $currentuser['special_details'] ; ?></td></tr>
					<tr><td><strong>Other Services:</strong></td><td style="text-align: right;"><?php echo $currentuser['other_services_provided'] ; ?></td></tr>
				    </tbody>
				</table>
			</div>
			
			
		</div>
	</div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script>
$(".productupdate_ajax").click(function() {
    var action = $(this).attr('myaction');
	var prodid = $(this).attr('prodid');
    var url = "z_scripts/admin_farm_agent_product_update.php?type="+action+"_product"; // the script where you handle the form input.
    var doreload = $(this).attr('doreload');
	
    $.ajax({
           type: "POST",
           url: url,
           data: {uid: <?php echo $currentuser['users_id'] ; ?>, prodid: prodid}, // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
			   if(doreload=='1'){ 
					$('#thisUser').html("<center><img src='img/loading_bar_dots.gif'/></center>");
					$('#thisUser').load("admin_farm_agent_editor.php?uid=<?php echo $currentuser['users_id']; ?>"); 
					
			   }
			   
           }
         });

    return false; // avoid to execute the actual submit of the form.
});
</script>