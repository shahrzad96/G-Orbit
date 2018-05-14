<?php

	include("databaseCon.php");
	$user = $_GET['userr'];
		
	$sql11 = "update player set status = 'offline' where user_name = '$user'; "; 
		
	$setOff  = $conn -> query($sql11);
	
	
	header('Location: index.php');
?>