<?php
	include('index.php');
	//, userName: myUser
	$chatID = $_GET['idd'];
	$currUser = $_GET['myUser'];
	$date = date("Y-m-d h:i:sa");
	$message = $_GET['msggg'];
  	
	$groupID = $_GET['gID'];
	
  //adding the chat to group_chat
	$sql = "INSERT INTO group_chat (group_ID, name, expiration_date) VALUES ('$groupID', '$chatID', '$date')";
	$res = $conn->query($sql);
	
	//adding the chat to start table
	$sql = "INSERT INTO start(user_name, group_ID, date) VALUES ('$currUser', '$groupID', '$date')";
	$res = $conn->query($sql);/**/
	
	$sql = "INSERT INTO writing(user_name, group_ID, chat_text, date) VALUES ('$currUser', '$groupID', '$message', '$date')";
	$res = $conn->query($sql);
	
	
?>