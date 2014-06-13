<?php

include 'z_scripts/db_connect.php';
page_protect();
checkFarmUser("logout");

/**** Set all PHP Variables as $info_(fieldname) for the info of the logged in user **/
include 'z_scripts/set_php_info_vars.php'; 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CSG FAST - Farmers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/stylesheet.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <header class="<?php echo $info_ui_color; ?>"> <!-- Header start -->
        <a href="#" class="logo_image"><span class="hidden-480">CSG FAST</span></a>
        
		<ul class="header_actions pull-left hidden-480 hidden-768">
            <li rel="tooltip" data-placement="bottom" title="Hide/Show main navigation" ><a href="#" class="hide_navigation"><i class="icon-chevron-left"></i></a></li>
        </ul>
        <ul class="header_actions">
		 <li rel="tooltip" data-placement="left" title="FAST color scheme" tablename="users" users_id="<?php echo $info_users_id; ?>" class="color_pick navigation_color_pick header_color_pick hidden-480"><a class="iconic" href="#"><i class="icon-th"></i></a>
                <ul>
                    <li><a color="blue" class="blue set_color" href="#"></a></li>
                    <li><a color="light_blue"  class="light_blue set_color" href="#"></a></li>
                    <li><a color="grey" class="grey set_color" href="#"></a></li>
                    <li><a color="dark_grey" class="dark_grey set_color" href="#"></a></li>
                    <li><a color="pink" class="pink set_color" href="#"></a></li>
                    <li><a color="red" class="red set_color" href="#"></a></li>
                    <li><a color="orange" class="orange set_color" href="#"></a></li>
                    <li><a color="yellow" class="yellow set_color" href="#"></a></li>
                    <li><a color="green" class="green set_color" href="#"></a></li>
                    <li><a color="dark_green" class="dark_green set_color" href="#"></a></li>
                    <li><a color="turq" class="turq set_color" href="#"></a></li>
                    <li><a color="dark_turq" class="dark_turq set_color" href="#"></a></li>
                    <li><a color="purple" class="purple set_color" href="#"></a></li>
                    <li><a color="violet" class="violet set_color" href="#"></a></li>
                    <li><a color="dark_blue" class="dark_blue set_color" href="#"></a></li>
                    <li><a color="dark_red" class="dark_red set_color" href="#"></a></li>
                    <li><a color="brown" class="brown set_color" href="#"></a></li>
                    <li><a color="black" class="black set_color" href="#"></a></li>
                </ul>
            </li>
            </li>
            <li class="dropdown"><a href="#"><img src="profile_pics/<?php echo $info_profile_pic; ?>" onError="this.src='http://farmersagent.com/Images/FarmersLogo_placements.jpg';" alt="User image" class="avatar"> <?php echo $info_full_name;?> <i class="icon-angle-down"></i></a>
                <ul>
                    <li><a href="#"><i class="icon-cog"></i> Edit Profile</a></li>
                    <li><a href="z_scripts/do_logout.php"><i class="icon-remove"></i> Logout</a></li>
                </ul>
            </li>
            <li><a href="z_scripts/do_logout.php"><i class="icon-signout"></i> <span class="hidden-768 hidden-480">Logout</span></a></li>
            <li class="responsive_menu"><a class="iconic" href="#"><i class="icon-reorder"></i></a></li>
        </ul>
    </header>

    <div id="main_navigation" class="<?php echo $info_ui_color; ?>"> <!-- Main navigation start -->
        <div class="inner_navigation">
            <ul class="main">
                <li class="active"><a href="home_page_farm.php"><i class="icon-home"></i> Dashboard</a></li>
				<li class=""><a href="farm_user_call_info.php"><i class="icon-list-alt"></i> Call Information</a></li>
				<li class=""><a href="#csg-view" data-toggle="modal"><i class="icon-eye-open"></i> What CSG Sees</a></li>
            </ul>
        </div>
    </div>  
    
	<!-- Popup Modal Start -->
	
	<div id="csg-view" class="modal container hide fade" tabindex="-1">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
            <h3>Full Width</h3>
        </div>
        <div class="modal-body">
            <p>This modal will resize itself to the same dimensions as the container class.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin ipsum ac ante fermentum suscipit. In ac augue non purus accumsan lobortis id sed nibh. Nunc egestas hendrerit ipsum, et porttitor augue volutpat non. Aliquam erat volutpat. Vestibulum scelerisque lobortis pulvinar. Aenean hendrerit risus neque, eget tincidunt leo. Vestibulum est tortor, commodo nec cursus nec, vestibulum vel nibh. Morbi elit magna, ornare placerat euismod semper, dignissim vel odio. Phasellus elementum quam eu ipsum euismod pretium.</p>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn grey">Close</a>
            <a href="#" class="btn red">Save changes</a>
        </div>
    </div>
	
	<!-- Popup Modal End -->
	
    <div id="content" class="no-sidebar"> <!-- Content start -->
        <div class="top_bar">
            <ul class="breadcrumb">
              <li><a href="home_page_farm.php"><i class="icon-home"></i></a> <span class="divider">/</span></li>
              <li class="active"><a href="#">Dashboard</a></li>
            </ul>
        </div>

            <div class="widgets_area">
				
				
				
				

            </div> 
			
			
			
			
        </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.10.3.js"></script>
    <script src="js/bootstrap.js"></script>

    <script src="js/library/jquery.collapsible.min.js"></script>
    <script src="js/library/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/library/jquery.mousewheel.min.js"></script>
    <script src="js/library/jquery.uniform.min.js"></script>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCL6XtCGot7S7cfxnO6tRfeZx9kLQQRMtA&amp;sensor=false"></script>
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

    <script src="js/library/bootstrap-datetimepicker.js"></script>
    <script src="js/library/bootstrap-timepicker.js"></script>
    <script src="js/library/bootstrap-datepicker.js"></script>
    <script src="js/library/bootstrap-fileupload.js"></script>
    <script src="js/library/jquery.inputmask.bundle.js"></script>
	
	<script src="js/library/editor/wysihtml5-0.3.0.js"></script>
    <script src="js/library/editor/bootstrap-wysihtml5.js"></script>

    <script src="js/flatpoint_core.js"></script>
	<script src="js/fast_web_user_settings.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/forms_advanced.js"></script>
	
	<script src="js/jquery.maskedinput.js"></script>
	
	<script src="js/library/bootstrap-modal.js"></script>
    <script src="js/library/bootstrap-modalmanager.js"></script>
    
	
	 <script type="text/javascript">
        jQuery(function($) {
            $('.footable').footable();
            $('.responsive_table_scroll').mCustomScrollbar({
                set_height: 400,
                advanced:{
                    updateOnContentResize: true,
                    updateOnBrowserResize: true
                }
            });
        });
    </script>
  </body>
</html>
