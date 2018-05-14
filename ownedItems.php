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
		$sql = "select game_code, name, number from purchase where user_name = '$userName'" ;
	}
	else{
		$sql = "select game_code, name from game_items" ;
	}
				
	
		$table  = $conn -> query($sql);
		
		$rowValue = "";
		$finalResult .= "<form id =\"plaGameForm\" method=\"post\" action = \"goplay.php\" >";
		$finalResult .= " <input type=\"hidden\" value=\"\"  id = \"accounCancel\"	name = \"input1\">	</form> " ;	
		$finalResult .= "<table id=\"playTable\" >";		
		$finalResult .= "<tr> <td> Game </td>  <td> Item </td> <td> Number </td> </tr>";
		while( $rowValue = $table->fetch_assoc() ){
			
			if (isset($_SESSION['loggedIn'])) {
				if($rowValue['number'] != Null && $rowValue['game_code'] != Null && $rowValue['name'] != Null){
					$gameName= $rowValue['game_code'];
					$item = $rowValue['name'];
					$number = $rowValue['number'];
				}
				else{
					$gameName = "NA";
					$item = "NA";
					$number = 0;
				}
			}
			else{
				$gameName= $rowValue['game_code'];
				$item = $rowValue['name'];
				$number = "NA";
			}		

			$finalResult .= " <tr> <td> $gameName </td>  <td> $item </td> <td> $number </td>  </tr> "  ;
			
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