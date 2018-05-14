<?php
	ob_start();
	include('index.php');
	ob_end_clean();
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	$whatGame = "";
	
	if(isset($_POST['whatGame'])){
		$whatGame = $_POST['whatGame'];
	}
	
	$userName= " to G-Orbit ";
	$chatOutput = "";
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}
	
	
	
		if (isset($_SESSION['loggedIn'])) {
			$sql = "select G.version from game G, buy B where G.game_code = B.game_code AND B.user_name = '$userName' AND G.game_code = '$whatGame'";
		}
		else{
			$sql = "select name, publisher, version from game";
		}
	
		$table  = $conn -> query($sql);
		
		//getting the current version of the game
		while($rowVal = $table->fetch_assoc()){
			$gameVersion = $rowVal['version'];
		}
		
		
		$sql = "update download set version = '$gameVersion' where user_name = '$userName' AND game_code = '$whatGame'";
		$res = $conn->query($sql);
		
		header("Location: play.php");

?>
