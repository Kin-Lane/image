<?php
$route = '/images/';
$app->get($route, function ()  use ($app){

	$ReturnObject = array();

	if(isset($_REQUEST['query'])){ $query = $_REQUEST['query']; } else { $query = '';}

	if($query=='')
		{
		$Query = "SELECT * FROM images WHERE name LIKE '%" . $query . "%' OR description LIKE '%" . $query . "%'";
		}
	else
		{
		$Query = "SELECT * FROM images";
		}

	$Query .= " ORDER BY name ASC";
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

		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
	});
?>
