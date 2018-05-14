

<?php
	
	session_start(); 
	include("databaseCon.php");
	
	$userName ="!";
	$chatOutput ="!!";
	$foundRes = "";
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$chatOutput = $_SESSION['chatOutput'];
	}	
	
	session_write_close();
	
	$sql = "select friend_name from friend_request where user_name= '$userName' " ;
	$table  = $conn -> query($sql);
	
	$rowValue = "";
	$foundRes = "";
		

	while( $rowValue = $table->fetch_assoc() ){
		
		$name= $rowValue['friend_name'];
		
		$foundRes .= "<a onclick='showNotifications()' >";
		$foundRes .= $name;
		$foundRes .= " wants to add you as a friend!</a><br>;";		
	}
	
	
	echo $foundRes;
	
	
	
?>