<?php

$geo = "us-east-1C";
$provider = "Amazon Web Services";
$hostname = "test";

$url = "http://server.api.stack.network/";

echo $url . "<br />";

$fields = array(
				'geo' => urlencode($geo),
				'provider' => urlencode($provider),
				'hostname' => urlencode($hostname),
				);

foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

$http = curl_init();

curl_setopt($http,CURLOPT_URL, $url);
curl_setopt($http,CURLOPT_POST, count($fields));
curl_setopt($http,CURLOPT_POSTFIELDS, $fields_string);

$output = curl_exec($http);
$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
$info = curl_getinfo($http);

//var_dump($info);

curl_close($http);

?>