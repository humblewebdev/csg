<script src="js/jquery-1.10.2.js"></script>
<?php 
include 'db_connect.php';

$url = $_GET['farm_url'];

//echo $url . PHP_EOL;

/** Post to URL to see if it is up **/
$ch = curl_init($url);

//echo $ch . PHP_EOL;

curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//echo "return code= " . $retcode . PHP_EOL;
curl_close($ch);
if (200!=$retcode) {// Farmers Agent website not found

?>
<script type="text/javascript">
//On email field update run check for duplicate user with same info
$(document).ready(function() {
    //alert('<?php echo $retcode;?>');
    document.getElementById("websitefound").innerHTML = ('');
    //document.getElementById("websitenotfound").innerHTML = ('<a href="#" class="red btn"><i class="icon-remove"></i> Not Found!</a>');
});
</script>

<?php
$mysqli->close(); //Close mysql connection that was started in the include file
exit;
}




$pull_pic = parse_url($url, PHP_URL_PATH);

//echo $pull_pic;

$url_pic = "http://www.farmersagent.com/Assets/Agents$pull_pic/ProfileImages$pull_pic.jpg";

//If the typed input is less than 2 characters, exit the script
if((strlen($pull_pic)) < 3 || $url == "http://www.farmersagent.com/"){
$mysqli->close(); 
?>
<script type="text/javascript">
//Clear buttons next to website input
$(document).ready(function() {
    document.getElementById("websitefound").innerHTML = ('');
    document.getElementById("websitenotfound").innerHTML = ('');
});
</script>
<?php
exit;
}

/******* Seperate piece to check for duplicate email already registered to exit script *****/
$emailcheck = substr($pull_pic, 1) . "@farmersagent.com";
$row_cnt_result = $mysqli->query("SELECT users_id FROM users WHERE email='$emailcheck';") or die(mysqli_error($mysqli));
/* check to see if user already exists */
$row_cnt = $row_cnt_result->num_rows;
if ($row_cnt > 0) {
?>

<script type="text/javascript">
//On email field update run check for duplicate user with same info
$(document).ready(function() {
    document.getElementById("websitefound").innerHTML = ('');
    document.getElementById("websitenotfound").innerHTML = ('<a href="#" class="red btn"><i class="icon-remove"></i> Agent Already Registered!</a>');
});
</script>

<?php
$mysqli->close(); //Close mysql connection that was started in the include file
exit;
}

$mysqli->close(); //Close mysql connection that was started in the include file
/********** End of Seperate Script ******************/

$url2 = "http://www.farmersagent.com$pull_pic";

$sites_html = file_get_contents($url2);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_URL, $url2);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0');
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10);
curl_setopt($ch,CURLOPT_TIMEOUT,10);
$content = curl_exec($ch);

$html = new DOMDocument();
@$html->loadHTML($content);
$meta_og_img = null;
$meta_og_title = null;
//Get all meta tags and loop through them.
foreach($html->getElementsByTagName('meta') as $meta) {
	//If the property attribute of the meta tag is og:image
	if($meta->getAttribute('property')=='og:image'){ 
		//Assign the value from content attribute to $meta_og_img
		$meta_og_img = $meta->getAttribute('content');
	}
	if($meta->getAttribute('property')=='og:title'){ 
		//Assign the value from content attribute to $meta_og_img
		$meta_og_title = $meta->getAttribute('content');
	}
	if($meta->getAttribute('property')=='og:url'){ 
		//Assign the value from content attribute to $meta_og_img
		$meta_og_url = $meta->getAttribute('content');
	}
	if($meta->getAttribute('property')=='og:description'){ 
		//Assign the value from content attribute to $meta_og_img
		$meta_og_desc = $meta->getAttribute('content');
	}
}

$titlenames = explode(",", $meta_og_title);
$name = explode(" ", trim($titlenames[0]));
$firstname = $name[0];
$lastname = $name[1]; //Last name with last character (comma) removed
$statecity = $titlenames[1] . ', ' . $titlenames[2]; //State and City Name Together
//$scsplit = explode(", ", $statecity);
$state = $titlenames[2];
$city = $titlenames[1];

if($meta_og_img == NULL){/*echo "No profile pic found"; */}
else{
echo '<a href="' . $meta_og_url . '" target="_blank" title="' . $meta_og_desc . '">
	  <img style="height: 60px; " align="right" src=' . $meta_og_img . ' />
	  </a>' .  "$firstname $lastname | $statecity &nbsp;<br>";
}

//Loop to parse page for the agents information in span fields with matching id names

		$adsplit = '';
		$zip = '';
		$county = '';
		$phone = '';
	foreach($html->getElementsByTagName('div') as $div) {
		if($div->getAttribute('class') == "street-address"){
		//$adsplit = preg_split("/$city/", $div->nodeValue); //Split up the address from the actual and on with included city and state
			$adsplit = $div->nodeValue;
		}
	}
	foreach($html->getElementsByTagName('span') as $span) {
		if($span->getAttribute('class') == "postal-code"){
		//$adsplit = preg_split("/$city/", $div->nodeValue); //Split up the address from the actual and on with included city and state
			$zip = $span->nodeValue;
		}

		$address = $adsplit;
		//$zip = substr($adsplit[1], -5); //Grab last 5 characters of address split string which is the zip
		$email = substr($pull_pic, 1,100) . '@farmersagent.com';


		if($span->getAttribute('class') == "value"){
			$phone =  $span->nodeValue; //Phone number with only numbers inside
		}
		
	}

	if($meta_og_img != NULL){
	//Search public records website for zip and parse county information to county variable
	$urlc = "http://publicrecords.onlinesearches.com/zip-ac.php?m=1&ZC=$zip";
	$sites_html2 = file_get_contents($urlc);

	$html2 = new DOMDocument();
	@$html2->loadHTML($sites_html2);

	foreach($html2->getElementsByTagName('table') as $span2) {
	$countysplit = preg_split("/$zip/", $span2->nodeValue);
	$countysplit2 = explode(", ", $countysplit[1]);
	$countysplit1 = explode(' County', $countysplit[1]);

	$county = $countysplit2[0];
	}
}
?>

<script type="text/javascript">
$(document).ready(function() {

     //Update all the fields via jquery and javascript
	 
	 var firstname = '<?php echo (isset($firstname)) ? trim($firstname) : ''; ?>';
	 var lastname = '<?php echo (isset($lastname)) ? trim($lastname) : '' ; ?>';
	 var address = '<?php echo (isset($address)) ? trim($address) : '' ; ?>';
	 var city = '<?php echo (isset($city)) ? trim($city) : ''; ?>';
	 var state = '<?php echo isset($state) ? trim($state) : ''; ?>';
	 var zip = '<?php echo isset($zip) ? trim($zip) : ''; ?>';
	 var email = '<?php echo (isset($email)) ? trim($email) : ''; ?>';
	 var website = '<?php echo isset($url2) ? trim($url2) : ''; ?>';
	 var county = '<?php echo (isset($county)) ? trim($county) : '' ; ?>';
	 var phone = '<?php echo (isset($phone)) ? trim($phone) : ''; ?>';
	 
	 document.getElementById("name").value = firstname;
	 document.getElementById("lastname").value = lastname;
	 document.getElementById("mainphone").value = phone;
	 document.getElementById("rback").value = phone;
	 document.getElementById("address").value = address;					
	 document.getElementById("city").value = city;
	 document.getElementById("county").value = county;
	 document.getElementById("zipcode").value = zip;
	 document.getElementById("email").value = email;
	 document.getElementById("agencyname").value = firstname + " " + lastname + " Agency";
	 
	 document.getElementById("mainphone_verify").innerHTML = phone;
	 document.getElementById("firstname_verify").innerHTML = firstname;
	 document.getElementById("lastname_verify").innerHTML = lastname;
	 document.getElementById("email_verify").innerHTML = email;	
	 
	 if(firstname != ""){
	 document.getElementById("websitenotfound").innerHTML = ('');
	 document.getElementById("websitefound").innerHTML = ('<a href="' + website + '" target="_blank" title="Visit your site..." class="dark_green btn"><i class="icon-check"></i> Found, Info Pre-Filled</a>');	
	 } else {
	 document.getElementById("websitefound").innerHTML = ('');
	 document.getElementById("websitenotfound").innerHTML = ('<a href="#" class="red btn"><i class="icon-remove"></i> Not Found!</a>');
	 }
	 
	 
	 $('#stateselect').val(state).change();
	 
	 //Clear agent code duplicate message if there is one
	 document.getElementById("dup_agentcode").innerHTML = "";
	  
});
</script>

				
			