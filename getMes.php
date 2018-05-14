<?php

	include('index.php');
	$chatID = $_GET['idd'];
	$currUser = $_GET['myUser'];
	$groupID = $_GET['gID'];
	
	
	//sending messages from friend
	$sql = "select chat_text from writing where user_name = '$chatID' AND group_ID = '$groupID'";
	$res = $conn->query($sql);
	while($rowValue = $res->fetch_assoc()){
		echo json_encode( $rowValue['chat_text']);
	}
?>

