<?php

	ob_start();
	include('index.php');
	ob_end_clean();
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	//var_dump($_SESSION);
	
	$usernName = " to G-Orbit ";
	$chatOutput = "";
	$loggedIn ="";
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}

	
	$finalResult = "";
				
		if (isset($_SESSION['loggedIn'])) {
			$sql = "select name, publisher, version, G.game_code from game G, buy B where G.game_code = B.game_code AND B.user_name = '$userName'";
			$sql1 = "select D.version from game G, download D where G.game_code = D.game_code AND D.user_name = '$userName'";
		}
		else{
			$sql = "select name, publisher, version from game";
			$sql1 = "select version from game";
		}
	
		$table  = $conn -> query($sql);
		$table1 = $conn -> query($sql1);
		
		//getting the current version of the game
		while($rowVal1 = $table1->fetch_assoc()){
			$gameVersion = $rowVal1['version'];
		}
		
		$rowValue = "";
		$finalResult .= "<form id =\"plaGameForm\" method=\"post\" action = \"goplay.php\" >";
		$finalResult .= " <input type=\"hidden\" value=\"\"  id = \"accounCancel\"	name = \"input1\">	</form> " ;	
		$finalResult .= "<table id=\"playTable\" >";		
		$finalResult .= "<tr> <td> Game </td>  <td> Publisher </td> <td> Version </td> <td> Play </td> </tr>";
		while( $rowValue = $table->fetch_assoc() ){
			
			$name= $rowValue['name'];
			$publisher = $rowValue['publisher'];
			$version = $rowValue['version'];
			$gameCode = $rowValue['game_code'];
	
			if($version == $gameVersion){
				$finalResult .= " <tr> <td> $name </td>  <td> $publisher </td> <td> $version </td> <td><button  onclick=\"playOwnedGame('$gameCode')\"   name=\"$name\" type=\"button\">Play Now!</button> </td> </tr> "  ;
			}
			else{
				$finalResult .= " <tr> <td> $name </td>  <td> $publisher </td> <td> $gameVersion </td> <td><button  onclick=\"downloadVersion('$gameCode')\"   name=\"$name\" type=\"button\">Download Now!</button> </td> </tr> "  ;

			}
			
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
			<div class="koka"> Welcome <?php echo($usernName) ?> </div>
			
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
		
		
		<?php if($gameVersion == $version){?>
		<form id ="playThisGame" method="post" action ="createSession.php">
				<input id="whatGame" type="hidden" name="whatGame" value="" >	 
		</form>
		<?php } else{ ?>
		<form id ="dowloadTheGame" method="post" action ="download.php">
				<input id="whatGame" type="hidden" name="whatGame" value="" >	 
		</form>
		<?php } ?>

		
		
		
		<p class="footer"> Cs353 Project		Done by: xxx XXX , yyy YYY, zzz ZZZ </p>
		
		<br><br><br><br><br><br><br><br><br>

	
		<script  src="jumping.js"> </script>
			<script >	
			
			
			$modalll = " aaaabbb";
			
			loggedIn = <?php echo $loggedIn; ?>;
			


		
			function playOwnedGame( name ){
				
				alert("trying to play: " + name );
				var game = document.getElementById("whatGame");
				game.value = name;
				document.getElementById("playThisGame").submit();
				
				//window.location.href = 'https://www.miniclip.com/games/8-ball-pool-multiplayer/en/#t-w-c-H';
				
			}
			
			function downloadVersion( name ){
				
				alert("trying to download: " + name );
				var game = document.getElementById("whatGame");
				game.value = name;
				document.getElementById("dowloadTheGame").submit();
				
				//window.location.href = 'https://www.miniclip.com/games/8-ball-pool-multiplayer/en/#t-w-c-H';
				
			}
			
		
		
		</script>

	
	
	</body>
	
	
</html>
