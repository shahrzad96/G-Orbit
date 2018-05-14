<?php 


	ob_start();
	include('index.php');
	ob_end_clean();
	

	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	$usernName= " to G-Orbit ";
	$chatOutput = "";
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}	
	
	//$whom = $_COOKIE['mycookie'];;
	$whom = $_GET['friend'];
	$date = date("Y/m/d");
	
	//echo "$whom  ??????";
	

	
	$sql = "insert into friend_request(user_name, friend_name,date) values('$userName','$whom', '$date')" ;

	$table  = $conn -> query($sql);
?>