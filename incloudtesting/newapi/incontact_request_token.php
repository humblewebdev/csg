
<?php
 // Below Code is Used to Capure Errors, Remove when Unneeded
 ini_set('display_errors', 1);
 error_reporting(E_ALL);

//set up variables
$base64 = base64_encode('Realtime_FAST_API@CSG_LLC:OTEyMzUwMDk5MTZjNGJjMmI1YjQ2MTVlZGIwMWFiMzA=');
$auth = "basic $base64";
$grant = "password";
$scope = "Admin Chat RealTime";
$username = "zachr@csgemail.com";
$password = "QwertY4321";
$theData = array('grant_type' => $grant, 'username' => $username, 'password' => $password, 'scope' => $scope);
$url = 'https://api-c6.incontact.com/InContactAuthorizationServer/Token';
$header_array = array('Authorization'=> $auth);


try {
   $r = new HttpRequest($url, HttpRequest::METH_POST);
   $r->setHeaders($header_array);
   $r->addPostFields($theData);
   $response = explode(",", $r->send()->getBody());
   $exp = explode(":", $response[0]);
   $clean_token = substr($exp[1], 1, -1);
   //echo $clean_token;

} catch (HttpException $ex) {
    echo $ex;
	
}

?>
