<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

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
							  ON t.users_id = t5.users_id WHERE user_level='1' LIMIT 10;");

$allfarmers = array(); // Associative array of all farmers users
$idfarm = 1;

while ($finfo = $allfarmers_query = $search_farm_users->fetch_assoc()) {
  $allfarmers[$idfarm] = $finfo; 
  $idfarm++;
}

?>
<div class="report-widgets hidden-480 hidden-768">
	<div class="row-fluid">
		<div class="span4">
			<div class="widget blue clearfix">
				<div class="content">
					<div class="icon">
						<i class="icon-user"></i>
						Total Farmers Agents
					</div>
					<div class="value">
						<?php echo count($allfarmers); ?>
					</div>
				</div>
				<a href="home_page_admin.php?ic=admin_farm_agent_table" class="more"><i class="icon-arrow-right"></i></a>
			</div>
		</div>
		<div class="span4">
			<div class="widget yellow clearfix">
				<div class="content">
					<div class="icon">
						<i class="icon-time"></i>
						Pending Users
					</div>
					<div class="value">
						<?php 
						$pfiltered = array_filter($allfarmers, function($v) { return $v['approved'] == '0'; });
						echo count($pfiltered);
						?>
					</div>
				</div>
				<a href="home_page_admin.php?ic=admin_farm_agent_table&tfilter_field=approved&tfilter_value=0" class="more"><i class="icon-arrow-right"></i></a>
			</div>
		</div>
		<div class="span4">
			<div class="widget orange clearfix">
				<div class="content">
					<div class="icon">
						<i class="icon-warning-sign"></i>
						Locked Users
					</div>
					<div class="value">
						<?php 
						$lfiltered = array_filter($allfarmers, function($v) { return $v['banned'] == '1'; });
						echo count($lfiltered);
						?>
					</div>
				</div>
				<a href="home_page_admin.php?ic=admin_farm_agent_table&tfilter_field=banned&tfilter_value=1" class="more"><i class="icon-arrow-right"></i></a>
			</div>
		</div>
	</div>
</div>
<hr></hr>


<div class="row-fluid">
	<div class="span4">
		<div class="well <?php echo $info_ui_color;?>">
			<div class="well-header">
				<h5>Recent Farmers Users</h5>
			</div>

			<div class="well-content">
				<div class="responsive_table_scroll">
					<table class="footable">
						<thead>
							<tr>
							    <th data-hide="phone" data-class="expand">&nbsp;</th>
								<th data-sort-initial="true">Agent Name</th>
								<!--<th data-hide="phone,tablet">Main Phone</th> -->
								<th data-sort-initial="true">Main Phone</th> 
								<th data-hide="phone,tablet">Cell Phone</th>
								<th data-hide="phone,tablet">Email</th>
								<th data-hide="phone,tablet">Reg. Date</th>
								<th data-hide="phone,tablet">Agency</th>
								<th data-hide="phone,tablet">City</th>
								<th data-hide="phone,tablet">Country</th>
								<!-- amber added -->
								<th data-sort-initial="true">Time Zone</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach($allfarmers as $farmuser){ ?>
							<tr>
							    <td><img style="height: 40px;" src="profile_pics/<?php echo $farmuser['profile_pic']; ?>" /></td>
								<td><?php echo $farmuser['firstname'] . " " . $farmuser['lastname'] . " (" . substr($farmuser['reg_date'], 0, 10) . ") "; ?></td>
								<td><?php echo formatPhone($farmuser['mainphone']); ?></td>
								<td><?php echo formatPhone($farmuser['cellphone']); ?></td>
								<td><?php echo $farmuser['email']; ?></td>
								<td><?php echo $farmuser['reg_date']; ?></td>
								<td><?php echo $farmuser['agencyname']; ?></td>
								<td><?php echo $farmuser['city'] . ", " . $farmuser['state'] . ", " .$farmuser['zipcode']; ?></td>
								<td><?php echo $farmuser['county']; ?></td>
								<!-- amber added -->
								<td><?php echo $farmuser['timezone']; ?></td>
								<td><?php if($farmuser['approved'] == '0'){echo "<span class='label label-warning'>Pending.."; } else if($farmuser['approved'] == '1'){echo "<span class='label label-success'>Approved"; } ?><span></td>
							</tr>
							<?php } ?>
						 </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="span4">
	
	</div>
	<div class="span4">
	
	</div>
    

</div>
