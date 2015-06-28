<?php
$route = '/images/:image_id/';
$app->delete($route, function ($image_id) use ($app){

	$ReturnObject = array();

	$query = "DELETE FROM images WHERE image_id = " . $image_id;
	//echo $query . "<br />";
	mysql_query($query) or die('Query failed: ' . mysql_error());

	$ReturnObject = array();
	$ReturnObject['message'] = "Image Deleted!";
	$ReturnObject['image_id'] = $image_id;

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_enode($ReturnObject)));

	});	
 ?>
