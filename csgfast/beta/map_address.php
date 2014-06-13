<?php
	include "z_scripts/db_connect.php";
	
	if(isset($_GET['users_id'])){
		$userid = $_GET['users_id'];
	}else{
		echo "user id is not set";
	}
	
	//Query the agent's address
	$address = $mysqli->query("SELECT address FROM farm_agent_info WHERE users_id = $userid")->fetch_object()->address; 
	//Query the agent's city
	$city = $mysqli->query("SELECT city FROM farm_agent_info WHERE users_id = $userid")->fetch_object()->city; 
	//Query the agent's city
	$state = $mysqli->query("SELECT state FROM farm_agent_info WHERE users_id = $userid")->fetch_object()->state; 
	$fulladdress = $address.", ".$city.", ".$state;	
	//Query the agent's full name
	$fullname = $mysqli->query("SELECT full_name FROM users WHERE users_id = $userid")->fetch_object()->full_name; 
	
	//Generate the lat and long from the user's address using Google API
	$prepAddr = str_replace(' ','+',$fulladdress);
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	$output= json_decode($geocode);
	$latitude = $output->results[0]->geometry->location->lat;
	$longitude = $output->results[0]->geometry->location->lng;
	
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CSG FAST: Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/stylesheet.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    
  </head>

  <body>
	<div class="span6">
		<div class="well dark_blue">
			<div class="well-header">
				<h5><?php echo "$fullname's Office Location: " .$fulladdress; ?></h5>
			</div>

			<div class="well-content no_padding">
				<div id="google-map" style="height: 380px;"></div>
			</div>
		</div>
	</div>

</body>
</html>
<!--------------------------  Le Java Scripts ------------------------------------>
	<script src="js/forms.js"></script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.10.3.js"></script>
    <script src="js/bootstrap.js"></script>

    <script src="js/library/jquery.collapsible.min.js"></script>
    <script src="js/library/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/library/jquery.mousewheel.min.js"></script>
    <script src="js/library/jquery.uniform.min.js"></script>

   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL6XtCGot7S7cfxnO6tRfeZx9kLQQRMtA&amp;sensor=false"></script>
    <script src="js/library/jquery.sparkline.min.js"></script>
    <script src="js/library/chosen.jquery.min.js"></script>
    <script src="js/library/jquery.easytabs.js"></script>
    <script src="js/library/flot/excanvas.min.js"></script>
    <script src="js/library/flot/jquery.flot.js"></script>
    <script src="js/library/flot/jquery.flot.pie.js"></script>
    <script src="js/library/flot/jquery.flot.selection.js"></script>
    <script src="js/library/flot/jquery.flot.resize.js"></script>
    <script src="js/library/flot/jquery.flot.orderBars.js"></script>
    <script src="js/library/maps/jquery.vmap.js"></script>
    <script src="js/library/maps/maps/jquery.vmap.world.js"></script>
    <script src="js/library/maps/data/jquery.vmap.sampledata.js"></script>
    <script src="js/library/jquery.autosize-min.js"></script>
    <script src="js/library/charCount.js"></script>
    <script src="js/library/jquery.minicolors.js"></script>
    <script src="js/library/jquery.tagsinput.js"></script>
    <script src="js/library/fullcalendar.min.js"></script>
    <script src="js/library/footable/footable.js"></script>
    <script src="js/library/footable/data-generator.js"></script>
	<script src="js/library/jquery.validate.js"></script>
	
    <script src="js/library/bootstrap-datetimepicker.js"></script>
    <script src="js/library/bootstrap-timepicker.js"></script>
    <script src="js/library/bootstrap-datepicker.js"></script>
    <script src="js/library/bootstrap-fileupload.js"></script>
	<script src="js/library/bootstrap-editable.js"></script>
	
	<script src="js/library/editor/wysihtml5-0.3.0.js"></script>
    <script src="js/library/editor/bootstrap-wysihtml5.js"></script>

    <script src="js/flatpoint_core.js"></script>
	<script src="js/fast_web_user_settings.js"></script>

	
	<script src="js/jquery.maskedinput.js"></script>
	<script src="js/home_page_admin.js"></script>
	
	<script src="js/library/bootstrap-modal.js"></script>
    <script src="js/library/bootstrap-modalmanager.js"></script>
	
	<script src="js/library/jquery.dataTables.js"></script>
    <script src="js/datatables.js"></script>
	<script src="js/forms_advanced.js"></script>
	<script src="js/library/bootstrapSwitch.js"></script>
	 <script src="js/html5shiv.js"></script>

<script>
jQuery(document).ready(function($) {
	var latitude = <?php echo $latitude; ?>;
	var longitude = <?php echo $longitude; ?>;
	var point  = new google.maps.LatLng(latitude,longitude);
	function initialize()
	{
		var mapProp= {
			center: new google.maps.LatLng(latitude,longitude),
			zoom: 18,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		var map=new google.maps.Map(document.getElementById("google-map"),mapProp);
		map.addOverlay(new Marker(point));
	};
	google.maps.event.addDomListener(window, 'load', initialize);
});
</script>