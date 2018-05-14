<?php

	include('index.php');
	$groupID = $_GET['gID'];
	
	//deleting chat when pop_up is closed (start)
	$sql = "delete from start where group_ID = '$groupID'";
	$res = $conn->query($sql);
	
	//deleting chat when pop_up is closed (writing)
	$sql = "delete from writing where group_ID = '$groupID'";
	$res = $conn->query($sql);
	
	//deleting chat when pop_up is closed (group_chat)
	$sql = "delete from group_chat where group_ID = '$groupID'";
	$res = $conn->query($sql);


?>