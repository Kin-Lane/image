<?php

$slug = "test";

$url = "http://server.api.stack.network/" . $slug . "/";

$http = curl_init($url);
curl_setopt($http, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($http, CURLOPT_HEADER, false);
curl_setopt($http, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($http);
$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
$info = curl_getinfo($http);
//var_dump($info);

echo $output;

curl_close($http);

?>