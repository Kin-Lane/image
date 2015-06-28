<?php
$route = '/images/sync/amazons3/';
$app->get($route, function ()  use ($app,$awsAccessKey,$awsSecretKey){

	$ReturnObject = array();

	if(isset($_REQUEST['bucket'])){ $bucket = $_REQUEST['bucket']; } else { $bucket = ''; }
	if(isset($_REQUEST['prefix'])){ $prefix = $_REQUEST['prefix']; } else { $prefix = ''; }

	//$bucket = "kinlane-productions";
	//$prefix = "bw-icons";

	$s3 = new S3($awsAccessKey, $awsSecretKey);
	$S3Images = $s3->getBucket($bucket,$prefix);
	//var_dump($S3Images);

	foreach($S3Images as $S3Image)
		{

		$name = $S3Image['name'];
		$imageUrl = "https://s3.amazonaws.com/kinlane-productions/" . $name;

		$name = str_replace($prefix,"",$name);
		$name = str_replace("/","",$name);
		$name = str_replace("-"," ",$name);
		$name = str_replace("_"," ",$name);

		$name = str_replace(".png","",$name);
		$name = str_replace(".gif","",$name);
		$name = str_replace(".jpg","",$name);
		$name = str_replace(".jpeg","",$name);
		$name = str_replace(".svg","",$name);

		$F = array();
		$F['name'] = $name;
		$F['imageUrl'] = $imageUrl;

		$ImageQuery = "SELECT * FROM images WHERE imageUrl = '" . $imageUrl . "'";
		//echo $ImageQuery . "<br />";
		$ImageResult = mysql_query($ImageQuery) or die('Query failed: ' . mysql_error());

		if($ImageResult && mysql_num_rows($ImageResult))
			{

			$Image = mysql_fetch_assoc($ImageResult);
			$image_id = $Image['image_id'];

			}
		else
			{

			$InsertQuery = "INSERT INTO images(";

			if(isset($name)){ $InsertQuery .= "name"; }
			if(isset($imageUrl)){ $InsertQuery .= ",imageUrl"; }
			if(isset($creator)){ $InsertQuery .= ",creator"; }

			$InsertQuery .= ") VALUES(";

			if(isset($name)){ $InsertQuery .= "'" . mysql_real_escape_string($name) . "'"; }
			if(isset($imageUrl)){ $InsertQuery .= ",'" . mysql_real_escape_string($imageUrl) . "'"; }
			if(isset($creator)){ $InsertQuery .= ",'" . mysql_real_escape_string($creator) . "'"; }

			$InsertQuery .= ")";

			//echo $InsertQuery . "<br />";
			mysql_query($InsertQuery) or die('Query failed: ' . mysql_error());
			$image_id = mysql_insert_id();

			}

		}

		$ReturnObject['sync'] = "complete";

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));

	});
 ?>
