<?php

include "soapconnection.php";

/* specify start end dates */
$end = $fdt;
$ftime = new DateTime('now');
$interval = new DateInterval('PT48H59M59S');
$ftime->sub($interval);
$start = $ftime->format('Y-m-d\TH:i:sP');

$params = array('applicationId' => $appID, 'reportNo' => 350048, 'startDate' => $start, 'endDate' => $end);
$call = array($client->CallDetailReport_Run($params));



var_dump($call);

?>