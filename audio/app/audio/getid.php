<?php

$slug = "test";

$url = "http://server.api.stack.network/" . $slug . "/";

$http = curl_init();  
curl_setopt($http, CURLOPT_URL, $url);  
curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   

$output = curl_exec($http);
$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
$info = curl_getinfo($http);
//var_dump($info);

echo $output;

curl_close($http);

?>