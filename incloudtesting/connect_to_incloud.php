<?php


/*
 ini_set('display_errors', 1);
 ini_set('log_errors', 1);
 ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
 error_reporting(E_ALL);

// Set Header Variables
$username = 'CultureServiceGrowth';
$password = 'CSGPass!';
$testappID = '59f2612a-1386-4f96-af4c-5748d904fbfc';
$appID = 'b0643d47-3c20-4c95-969f-caab2841f9fa';
$namespace = 'https://incloudws.incontact.com/inCloudWS.asmx?WSDL';
$ns = 'inCloudService';

// setup a SOAP client
$client = new SOAPClient($namespace,array('trace' => true, "soap_version" => SOAP_1_2));

// create SOAP header
$headerbody = array('Username' => $username, 'Password' => $password);
$header = new SOAPHeader($ns, 'AuthenticationHeader', $headerbody, false);

// Set Header
$client->__setSOAPHeaders($header);

// Set Body
$appID = array('applicationId' => $testappID);


// client calls
//$myarr array = array($client->Agent_GetList($appID));

//var_dump($myarr);
//$client -> __soapCall("Agent_GetList($appID)", array($result);

?>
<br><b>Test AppID:</b> <?php var_dump($client->TestApplicationConnection($appID)); ?>
<?php 
			
			$d = array($client->Skill_GetList($appID));
            $b = $d[0]->Skill_GetListResult->inSkill;

            $i=-1;
            foreach($b as $person){ $i++;?>

           <?php $skill = $d[0]->Skill_GetListResult->inSkill[$i];  ?>

           <?php 
           $name = $skill->SkillName;
		   $no = $skill->SkillNo;
		   ?>
           <option value="<?php echo $no;?> - <?php echo $name;?>"><?php echo $no;?> - <?php echo $name;?></option>
           <?php } 
*/		   
		   ?>