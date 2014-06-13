<?php 
include 'db_connect.php';

$type=$_GET['type'];

if($type=="approve_product"){ 
     $uid = $_POST['uid'];
	 $prodid = $_POST['prodid'];
     $getuserdata = $mysqli->query("SELECT * FROM farm_agent_info where users_id='$uid';") or die($mysqli->error);
	 $userdata = $getuserdata->fetch_object();
	 $prevprods = $userdata->fast_products_approved;
	 
        //echo "Current Approved: " . $prevprods . "\n";
		$curappexp = explode("#", $prevprods);
		
		// Search
		$pos = array_search($prodid, $curappexp);
        
		if($pos != NULL){
		echo "Error: Cannot approve product because it was already approved.";
		exit;
        }
		// Add to array
		array_push($curappexp, $prodid);
		$pound_separated = implode("#", $curappexp);
		//echo "After Approved: " . $pound_separated . "\n";
		
		$mysqli->query("UPDATE farm_agent_info SET fast_products_approved='$pound_separated' where users_id='$uid';") or die($mysqli->error);
		echo "Product ID: $prodid has now been added to this user";
   
}

if($type=="remove_product"){ 
    $uid = $_POST['uid'];
	 $prodid = $_POST['prodid'];
     $getuserdata = $mysqli->query("SELECT * FROM farm_agent_info where users_id='$uid';") or die($mysqli->error);
	 $userdata = $getuserdata->fetch_object();
	 $prevprods = $userdata->fast_products_approved;
	 
        //echo "Current Approved: " . $prevprods . "\n";
		$curappexp = explode("#", $prevprods);
		
		// Search
		$pos = array_search($prodid, $curappexp);
        if($pos != NULL){
		//echo "$prodid found at: " . $pos . "\n";

		// Remove from array
		unset($curappexp[$pos]);
		$pound_separated = implode("#", $curappexp);
		//echo "After Approved: " . $pound_separated . "\n";
		$mysqli->query("UPDATE farm_agent_info SET fast_products_approved='$pound_separated' where users_id='$uid';") or die($mysqli->error);
		echo "Product ID: $prodid has now been removed from this user";
		} else { echo "Error: Cannot un-approve product since it wasn't approved in the first place."; }
} 

?>