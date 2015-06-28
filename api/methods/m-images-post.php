<?php
$route = '/images/';
$app->post($route, function () use ($app){

 	$request = $app->request();
 	$param = $request->params();

	if(isset($param['name'])){ $name = $param['name']; } else { $name = 'No Name'; }
	if(isset($param['description'])){ $description = $param['description']; } else { $description = ''; }
	if(isset($param['imageUrl'])){ $imageUrl = $param['imageUrl']; } else { $imageUrl = ''; }
	if(isset($param['thumbnailUrl'])){ $thumbnailUrl = $param['thumbnailUrl']; } else { $thumbnailUrl = ''; }
	if(isset($param['width'])){ $width = $param['width']; } else { $width = ''; }
	if(isset($param['height'])){ $height = $param['height']; } else { $height = ''; }
	if(isset($param['creator'])){ $creator = $param['creator']; } else { $creator = ''; }

  	$LinkQuery = "SELECT * FROM images WHERE imageUrl = '" . $imageUrl . "'";
	//echo $LinkQuery . "<br />";
	$LinkResult = mysql_query($LinkQuery) or die('Query failed: ' . mysql_error());

	if($LinkResult && mysql_num_rows($LinkResult))
		{
		$Link = mysql_fetch_assoc($LinkResult);

		$image_id = $Link['image_id'];

		$ReturnObject = array();
		$ReturnObject['message'] = "images Already Exists!";
		$ReturnObject['image_id'] = $image_id;

		}
	else
		{

		$query = "INSERT INTO images(";

		if(isset($name)){ $query .= "name,"; }
		if(isset($description)){ $query .= "description,"; }
		if(isset($imageUrl)){ $query .= "imageUrl,"; }
		if(isset($thumbnailUrl)){ $query .= "thumbnailUrl,"; }
		if(isset($width)){ $query .= "width,"; }
		if(isset($height)){ $query .= "height,"; }
		if(isset($creator)){ $query .= "creator"; }

		$query .= ") VALUES(";

		if(isset($name)){ $query .= "'" . mysql_real_escape_string($name) . "',"; }
		if(isset($description)){ $query .= "'" . mysql_real_escape_string($description) . "',"; }
		if(isset($imageUrl)){ $query .= "'" . mysql_real_escape_string($imageUrl) . "',"; }
		if(isset($thumbnailUrl)){ $query .= "'" . mysql_real_escape_string($thumbnailUrl) . "',"; }
		if(isset($width)){ $query .= "'" . mysql_real_escape_string($width) . "',"; }
		if(isset($height)){ $query .= "'" . mysql_real_escape_string($height) . "',"; }
		if(isset($creator)){ $query .= "'" . mysql_real_escape_string($creator) . "'"; }

		$query .= ")";

		//echo $query . "<br />";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		$image_id = mysql_insert_id();

		$ReturnObject = array();
		$ReturnObject['message'] = "Image Added";
		$ReturnObject['image_id'] = $image_id;

		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));

	});
 ?>
