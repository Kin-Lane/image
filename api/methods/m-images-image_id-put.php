<?php
$route = '/images/:image_id/';
$app->put($route, function ($image_id) use ($app){

 	$request = $app->request();
 	$param = $request->params();

	if(isset($param['name'])){ $name = $param['name']; } else { $name = ''; }
	if(isset($param['description'])){ $description = $param['description']; } else { $description = ''; }
	if(isset($param['imageUrl'])){ $imageUrl = $param['imageUrl']; } else { $imageUrl = ''; }
	if(isset($param['thumbnailUrl'])){ $thumbnailUrl = $param['thumbnailUrl']; } else { $thumbnailUrl = ''; }
	if(isset($param['width'])){ $width = $param['width']; } else { $width = ''; }
	if(isset($param['height'])){ $height = $param['height']; } else { $height = ''; }
	if(isset($param['creator'])){ $creator = $param['creator']; } else { $creator = ''; }

  	$LinkQuery = "SELECT * FROM images WHERE image_id = " . $image_id;
	//echo $LinkQuery . "<br />";
	$LinkResult = mysql_query($LinkQuery) or die('Query failed: ' . mysql_error());

	if($LinkResult && mysql_num_rows($LinkResult))
		{
		$query = "UPDATE images SET ";

		if(isset($name))
			{
			$query .= "name='" . mysql_real_escape_string($name) . "'";
			}
		if(isset($description))
			{
			$query .= ",description='" . mysql_real_escape_string($description) . "'";
			}
		if(isset($imageUrl))
			{
			$query .= ",imageUrl='" . mysql_real_escape_string($imageUrl) . "'";
			}
		if(isset($thumbnailUrl))
			{
			$query .= ",thumbnailUrl='" . mysql_real_escape_string($thumbnailUrl) . "'";
			}
		if(isset($width))
			{
			$query .= ",width='" . mysql_real_escape_string($width) . "'";
			}
		if(isset($height))
			{
			$query .= ",height='" . mysql_real_escape_string($height) . "'";
			}
		if(isset($creator))
			{
			$query .= ",creator='" . mysql_real_escape_string($creator) . "'";
			}

		$query .= " WHERE image_id = " . $image_id;

		//echo $query . "<br />";
		mysql_query($query) or die('Query failed: ' . mysql_error());

		$ReturnObject = array();
		$ReturnObject['message'] = "images Updated!";
		$ReturnObject['image_id'] = $image_id;

		}
	else
		{
		$Link = mysql_fetch_assoc($LinkResult);

		$ReturnObject = array();
		$ReturnObject['message'] = "images Doesn't Exist!";
		$ReturnObject['image_id'] = $image_id;

		}

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));

	});
 ?>
