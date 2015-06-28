<?php
$route = '/images/:image_id/tags/';
$app->get($route, function ($image_id)  use ($app){


	$ReturnObject = array();

	$Query = "SELECT t.tag_id, t.tag, count(*) AS Profile_Count from tags t";
	$Query .= " JOIN image_tag_pivot ptp ON t.tag_id = ptp.tag_id";
	$Query .= " WHERE ptp.image_id = " . $image_id;
	$Query .= " GROUP BY t.tag ORDER BY count(*) DESC";

	$DatabaseResult = mysql_query($Query) or die('Query failed: ' . mysql_error());

	while ($Database = mysql_fetch_assoc($DatabaseResult))
		{

		$tag_id = $Database['tag_id'];
		$tag = $Database['tag'];
		$images_count = $Database['Profile_Count'];

		$F = array();
		$F['tag_id'] = $tag_id;
		$F['tag'] = $tag;
		$F['images_count'] = $images_count;

		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
	});	
 ?>
