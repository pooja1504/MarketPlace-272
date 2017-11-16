<?php

	$commentData = $_POST['comment'];
	$content = $commentData['content'];
	$dateTime = $commentData['created'];
	
	$rating = $_POST['rating'];
	$merchantId = $_POST['merchantId'];
	$productId = $_POST['productId'];
	$commentUsername = $_POST['username'];
	
	$comment = str_replace("\n","",$content);
	
	$date = explode("T",$dateTime);

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
	
	$sql = "INSERT INTO productrating (merchantid,productid,rating,comment,username,date) VALUES ('$merchantId','$productId','$rating','$comment','$commentUsername','$date[0]')";
		
	$result = mysqli_query($conn, $sql);
	
	if (!$result) {
		die('Invalid query: ' . mysqli_error($conn));
	}
	
	mysqli_close($conn);
?>
