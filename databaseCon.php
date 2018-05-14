<?php
	$servername = 'dijkstra.ug.bcc.bilkent.edu.tr';
	$myusername = 'seyedehshahrzad';
	$mypassword = 'gh8zquz4j';

	// Create connection
	$conn = mysqli_connect($servername, $myusername, $mypassword, 'seyedehshahrzad');

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
?>