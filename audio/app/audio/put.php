<?php

$slug = "test";

$geo = "us-east-1CC";
$provider = "Amazon Web Services";
$hostname = "test";

$url = "http://server.api.stack.network/" . $slug . "/";

$http = curl_init($url);
$data = array(
				'geo' => $geo,
				'provider' => $provider,
				'hostname' => $hostname
				);

curl_setopt($http, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($http, CURLOPT_HEADER, false);
curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
curl_setopt($http, CURLOPT_POSTFIELDS, http_build_query($data));

$output = curl_exec($http);
$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
$info = curl_getinfo($http);
//var_dump($info);

echo $output;

curl_close($http);