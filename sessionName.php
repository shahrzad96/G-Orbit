<?php
	include('index.php');
	
	$name = $_GET['sesName'];
	$currUser = $_SESSION['userName'];
	$date = date("Y-m-d h:i:sa");
	
	
  //adding the chat to group_chat
	$sql = "INSERT INTO session (user_name, name, date) VALUES ('$currUser', '$name', '$date')";
	$res = $conn->query($sql);

?>