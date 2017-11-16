<?php

	header('Content-Type: application/json');

	$merchantId = $_POST['merchantId'];
	$productId = $_POST['productId'];

	// Database connection parameters
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "marketplace_db";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "select * from productrating where productid='$productId' AND merchantid='$merchantId'";
		
	$result = mysqli_query($conn, $sql);
	
	if (!$result) {
		die('Invalid query: ' . mysqli_error($conn));
	}
	
	$ratingsContainerArray = [];
	
	while($row = mysqli_fetch_array($result)){
		$ratingArray['id'] = $row['reviewid'];
		$ratingArray['content'] = $row['comment'];
		$ratingArray['fullname'] = $row['username'];
		$ratingArray['created'] = $row['date'];
		$ratingArray['rating'] = $row['rating'];
		array_push($ratingsContainerArray,$ratingArray);
	}
	
	mysqli_close($conn);
	
	echo json_encode($ratingsContainerArray);
?> 
