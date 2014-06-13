<?php
 // Below Code is Used to Capure Errors, Remove when Unneeded
 ini_set('display_errors', 1);
 ini_set('log_errors', 1);
 ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
 error_reporting(E_ALL);
 // Above Code is Used to Capure Errors, Remove when Unneeded
 
        		
		$wsdl = "https://incloudws.incontact.com/inCloudWS.asmx?WSDL";
		$uriurl = "https://incloud.incontact.com/APIReference.aspx";
		$apiuser= "CSGPartner"; //webservice user login
        $apikey = "GjW%4iLk^6"; //webservice user pass
		
		//set up options array
        $options = array(
        "soap_version" => SOAP_1_2, 
        "location" => $wsdl, 
		"uri"      => $wsdl,
        "login" => $apiuser, 
        "password" => $apikey
        );
		
		//user authentication array
        $user_auth = array(
        "user_name" => $apiuser,
        "password" => $apikey
        );
		
		
		
        $client = new SoapClient(null,$options); //soap handle
        
		$appid = "59f2612a-1386-4f96-af4c-5748d904fbfc"; // Application ID
        $action = "TestConnection()"; //an action to call later (loading Sales Order List)
		 
	    //$soap_auth = new SOAP_AuthStruct($apiuser, $apikey);
        //$soap_header = new SoapHeader($soap_ns,'AuthHeader',$soap_auth,FALSE);
	
	
		 try { 
         //$sess_id = $client->login($user_auth, $apiuser);
		 //print_r($sess_id); 
			
        }
        catch (Exception $e) { //while an error has occured
            echo "==> Error: ".$e->getMessage(); //we print this
               exit();
        }

		//echo $action;
		$functions = $client->__getFunctions();
         var_dump ($functions);
       ?>