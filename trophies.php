<?php
	ob_start();
	include('index.php');
	ob_end_clean();
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	//var_dump($_SESSION);
	
	$usernName =" to G-Orbit" ;
	$chatOutput = "";
	
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}

	
	
	$finalResult = "";
	
	if (isset($_SESSION['loggedIn'])) {
		$sql = "select T.game_code, T.name, T.bonus_points from buy B, trophies T where B.user_name = '$userName' AND B.game_code = T.game_code" ;
	}
	else{
		$sql = "select game_code, name, bonus_points from trophies" ;
	}
				
	
		$table  = $conn -> query($sql);
		
		$rowValue = "";
		$finalResult .= "<form id =\"plaGameForm\" method=\"post\" action = \"goplay.php\" >";
		$finalResult .= " <input type=\"hidden\" value=\"\"  id = \"accounCancel\"	name = \"input1\">	</form> " ;	
		$finalResult .= "<table id=\"playTable\" >";		
		$finalResult .= "<tr> <td> Game </td>  <td> Trophy </td> <td> Bonus Points </td> </tr>";
		while( $rowValue = $table->fetch_assoc() ){
			
			if (isset($_SESSION['loggedIn'])) {
				if($rowValue['game_code'] != Null && $rowValue['name'] != Null && $rowValue['bonus_points'] != Null){
					$gameName= $rowValue['game_code'];
					$trophy = $rowValue['name'];
					$bonusPoints = $rowValue['bonus_points'];
				}
				else{
					$gameName = "NA";
					$trophy = "NA";
					$bonusPoints = 0;
				}
			}
			else{
				$gameName= $rowValue['game_code'];
				$trophy = $rowValue['name'];
				$bonusPoints = $rowValue['bonus_points'];
			}		

			$finalResult .= " <tr> <td> $gameName </td>  <td> $trophy </td> <td> $bonusPoints </td>  </tr> "  ;
			
		}
		
		$finalResult .= "</table> "  ;	
		
	$conn->close();
		
	session_write_close();


?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="jquery-3.3.1.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="stylesheet" type="text/css" href="cs353index.css">
<title>G-Orbit</title>
</head>

	<body  class="body" bgcolor="#000000"  >

		<body  class="body" bgcolor="#ffffff"  >

		<div class="topPart">
			<div class="koka"> Welcome <?php echo($userNameTop) ?> </div>
		
		<?php include("include/notification.html")?>

		<?php include("include/loginRightTop.html")?>
		
			<br><br><br>
		</div>
		
		<?php include("include/mainBar.html")?>
		
		
		
		<hr class="spaceLine" >
		
		
		
		<div class="playGames">
		<h1>Games Owned </h1>
		
			<?php echo $finalResult ?> 
		
		</div>
		
		
		
		<hr class="spaceLine" >
		
		
		<p class="footer"> Cs353 Project		Done by: xxx XXX , yyy YYY, zzz ZZZ </p>
		
		<br><br><br><br><br><br><br><br><br>
		
		<?php include("include/sourceModal.html")?>
		<?php include("include/accountModal.html")?>
		
		
		<form id ="logOutFormHidden" method="post" action ="index.php">
				<input id="logout" type="hidden" name="logout" value="ADSASD" >	 
		</form>
		
		<div class="chat_box">
			<div class="chat_head" onclick="hideChatBody()"> Chatt </div>
			<div class="chat_body" id="chat_body">
				<?php echo $chatOutput; ?>
			</div>
		</div>
		
	</body>
	
		<script  src="jumping.js"> </script>
		
		<script  language="javascript" type="text/javascript">
	

	
		</script>	
	
</html>