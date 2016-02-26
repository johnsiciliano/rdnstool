<?php

function doRDNS($IPADDRESS,$RDNSNAME) {
	$whmusername = "root";
	$whmhash = "CPANELKEYHASH
";
	$arr2 = preg_split('/[.]/', $IPADDRESS);
	echo $arr2[0];
	echo '.';
	echo $arr2[1];
	echo '.';
	echo $arr2[2];
	echo '.';
	echo $arr2[3];
	echo PHP_EOL;

	$finalip = $arr2[2].'.'.$arr2[1].'.'.$arr2[0].'.in-addr.arpa';
	echo $finalip;
	echo $arr2[3];
	$LAST3=$arr2[3];

	$query = "https://web.terafire.net:2087/json-api/addzonerecord?zone=$finalip&name=$LAST3&ptrdname=$RDNSNAME&type=PTR";
	$curl = curl_init();
# Create Curl Object
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
# Allow certs that do not match the domain
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
# Allow self-signed certs
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
# Return contents of transfer on curl_exec
$header[0] = "Authorization: WHM $whmusername:" . preg_replace("'(\r|\n)'","",$whmhash);
# Remove newlines from the hash
curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
# Set curl header
curl_setopt($curl, CURLOPT_URL, $query);
# Set your URL
$result = curl_exec($curl);
# Execute Query, assign to $result
if ($result == false) {
    error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
}
curl_close($curl);

}

