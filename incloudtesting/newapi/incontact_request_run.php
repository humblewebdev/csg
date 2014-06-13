
<?php

include 'incontact_request_token.php';

function curlRequest($url, $authHeader) {
    //Initialize the Curl Session.
    $ch = curl_init();
    //Set the Curl url.
    curl_setopt ($ch, CURLOPT_URL, $url);
    //Set the HTTP HEADER Fields.
    curl_setopt ($ch, CURLOPT_HTTPHEADER, array($authHeader,"Content-Type: application/json; charset=UTF-8","Accept: application/json, text/javascript, */*; q=0.01"));
    //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, False);
    //Execute the  cURL session.
    $curlResponse = curl_exec($ch);
    //Get the Error Code returned by Curl.
    $curlErrno = curl_errno($ch);
    if ($curlErrno) {
        $curlError = curl_error($ch);
        throw new Exception($curlError);
    }
    //Close a cURL session.
    curl_close($ch);
    //echo $curlResponse;
	var_dump(json_decode($curlResponse, true));
}

$url = 'https://api-c6.incontact.com/inContactAPI/services/v1.0/agents/223344';
$auth = 'bearer ' . $clean_token;
$header_array = array('Authorization'=> $auth);
$auth_head = "Authorization: $auth";

try {
	curlRequest($url, $auth_head);
} catch (HttpException $ex) {
    echo $ex;
	
}

?>
