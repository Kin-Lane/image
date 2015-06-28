<?php
$route = '/images/:image_id/';
$app->get($route, function ($image_id)  use ($app){


	$ReturnObject = array();

	$Query = "SELECT * FROM images WHERE image_id = " . $image_id;
	//echo $Query . "<br />";

	$imagesResult = mysql_query($Query) or die('Query failed: ' . mysql_error());

	while ($images = mysql_fetch_assoc($imagesResult))
		{

		$image_id = $images['image_id'];
		$name = $images['name'];
		$description = $images['description'];
		$imageUrl = $images['imageUrl'];
		$thumbnailUrl = $images['thumbnailUrl'];
		$width = $images['width'];
		$height = $images['height'];
		$creator = $images['creator'];

		// manipulation zone

		$F = array();
		$F['image_id'] = $image_id;
		$F['name'] = $name;
		$F['description'] = $description;
		$F['imageUrl'] = $imageUrl;
		$F['thumbnailUrl'] = $thumbnailUrl;
		$F['width'] = $width;
		$F['height'] = $height;
		$F['creator'] = $creator;

		$ReturnObject = $F;
		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
	});
 ?>
